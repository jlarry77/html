// Get canvas and context
const canvas = document.getElementById('sphereCanvas');
const ctx = canvas.getContext('2d');

// Set canvas size to match its container
canvas.width = canvas.offsetWidth;
canvas.height = canvas.offsetHeight;

// Sphere properties
const sphereRadius = 55; // Radius of the sphere
const numLatLines = 18; // Number of latitudinal lines
const numLonLines = 36; // Number of longitudinal lines
const rotationSpeed = 0.01; // Base rotation speed

// Cube properties
const cubeSize = sphereRadius * 2.5; // Slightly larger than the sphere

// Points array for sphere and cube
let spherePoints = [];
let cubePoints = [];

// Generate points for the sphere
for (let lat = 0; lat <= numLatLines; lat++) {
  const theta = (lat * Math.PI) / numLatLines; // Polar angle
  for (let lon = 0; lon < numLonLines; lon++) {
    const phi = (lon * 2 * Math.PI) / numLonLines; // Azimuthal angle
    const x = sphereRadius * Math.sin(theta) * Math.cos(phi);
    const y = sphereRadius * Math.sin(theta) * Math.sin(phi);
    const z = sphereRadius * Math.cos(theta);
    spherePoints.push({ x, y, z });
  }
}

// Generate points for the cube
const halfSize = cubeSize / 2;
cubePoints = [
  { x: -halfSize, y: -halfSize, z: -halfSize },
  { x: halfSize, y: -halfSize, z: -halfSize },
  { x: halfSize, y: halfSize, z: -halfSize },
  { x: -halfSize, y: halfSize, z: -halfSize },
  { x: -halfSize, y: -halfSize, z: halfSize },
  { x: halfSize, y: -halfSize, z: halfSize },
  { x: halfSize, y: halfSize, z: halfSize },
  { x: -halfSize, y: halfSize, z: halfSize }
];

// Edges of the cube (pairs of point indices)
const cubeEdges = [
  [0, 1], [1, 2], [2, 3], [3, 0],
  [4, 5], [5, 6], [6, 7], [7, 4],
  [0, 4], [1, 5], [2, 6], [3, 7]
];

// Function to rotate a point around the Y-axis
function rotateY(point, angle) {
  const cos = Math.cos(angle);
  const sin = Math.sin(angle);
  const x = point.x * cos - point.z * sin;
  const z = point.x * sin + point.z * cos;
  return { ...point, x, z };
}

// Function to rotate a point around the X-axis
function rotateX(point, angle) {
  const cos = Math.cos(angle);
  const sin = Math.sin(angle);
  const y = point.y * cos - point.z * sin;
  const z = point.y * sin + point.z * cos;
  return { ...point, y, z };
}

// Function to rotate a point around the Z-axis
function rotateZ(point, angle) {
  const cos = Math.cos(angle);
  const sin = Math.sin(angle);
  const x = point.x * cos - point.y * sin;
  const y = point.x * sin + point.y * cos;
  return { ...point, x, y };
}

// Render loop
function render() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  // Rotate sphere points around all axes
  spherePoints = spherePoints.map((point) => rotateY(rotateX(rotateZ(point, rotationSpeed / 3), rotationSpeed / 2), rotationSpeed));

  // Rotate cube points around all axes (slower rotation)
  cubePoints = cubePoints.map((point) => rotateY(rotateX(rotateZ(point, rotationSpeed / 6), rotationSpeed / 8), rotationSpeed / 10));

  // Draw the sphere as dots
  spherePoints.forEach((point) => {
    const perspective = canvas.width / (canvas.width + point.z);
    const x = point.x * perspective + canvas.width / 2;
    const y = point.y * perspective + canvas.height / 2;

    ctx.beginPath();
    ctx.arc(x, y, 1, 0, 2 * Math.PI); // Draw a small dot
    ctx.fillStyle = '#6397C9';
    ctx.fill();
  });

  // Draw the cube edges
  cubeEdges.forEach(([startIdx, endIdx]) => {
    const start = cubePoints[startIdx];
    const end = cubePoints[endIdx];

    const perspectiveStart = canvas.width / (canvas.width + start.z);
    const x1 = start.x * perspectiveStart + canvas.width / 2;
    const y1 = start.y * perspectiveStart + canvas.height / 2;

    const perspectiveEnd = canvas.width / (canvas.width + end.z);
    const x2 = end.x * perspectiveEnd + canvas.width / 2;
    const y2 = end.y * perspectiveEnd + canvas.height / 2;

    ctx.beginPath();
    ctx.moveTo(x1, y1);
    ctx.lineTo(x2, y2);
    ctx.strokeStyle = '#003793';
    ctx.lineWidth = 0.5;
    ctx.stroke();
  });

  requestAnimationFrame(render);
}

// Start rendering
render();
