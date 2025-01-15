const canvas = document.getElementById('sphereCanvas');
const ctx = canvas.getContext('2d');

// Set canvas size to match its container
canvas.width = canvas.offsetWidth;
canvas.height = canvas.offsetHeight;

// Sphere properties
const sphereRadius = 55; // Adjusted radius for smaller canvas
const numLatLines = 18; // Number of latitudinal lines (horizontal)
const numLonLines = 36; // Number of longitudinal lines (vertical)
const rotationSpeed = 0.01; // Base rotation speed

// Points array for structured wireframe
let points = [];

// Generate points for latitudinal and longitudinal lines
for (let lat = 0; lat <= numLatLines; lat++) {
  const theta = (lat * Math.PI) / numLatLines; // Polar angle (0 to PI)
  for (let lon = 0; lon < numLonLines; lon++) {
    const phi = (lon * 2 * Math.PI) / numLonLines; // Azimuthal angle (0 to 2PI)
    const x = sphereRadius * Math.sin(theta) * Math.cos(phi);
    const y = sphereRadius * Math.sin(theta) * Math.sin(phi);
    const z = sphereRadius * Math.cos(theta);
    points.push({ x, y, z });
  }
}

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

  // Rotate points on multiple axes
  points = points.map((point) => rotateY(point, rotationSpeed));
  points = points.map((point) => rotateX(point, rotationSpeed / 2));
  points = points.map((point) => rotateZ(point, rotationSpeed / 3));

  // Draw the sphere's wireframe
  for (let i = 0; i < points.length; i++) {
    for (let j = i + 1; j < points.length; j++) {
      // Only connect points that form a grid (latitudinal or longitudinal neighbors)
      const dx = points[i].x - points[j].x;
      const dy = points[i].y - points[j].y;
      const dz = points[i].z - points[j].z;
      const distance = Math.sqrt(dx * dx + dy * dy + dz * dz);

      if (distance < sphereRadius * (2 * Math.PI / numLonLines)) {
        const perspective1 = canvas.width / (canvas.width + points[i].z);
        const x1 = points[i].x * perspective1 + canvas.width / 2;
        const y1 = points[i].y * perspective1 + canvas.height / 2;

        const perspective2 = canvas.width / (canvas.width + points[j].z);
        const x2 = points[j].x * perspective2 + canvas.width / 2;
        const y2 = points[j].y * perspective2 + canvas.height / 2;

        ctx.beginPath();
        ctx.moveTo(x1, y1);
        ctx.lineTo(x2, y2);
        ctx.strokeStyle = 'rgba(255,255,255,.25)';  // Change sphere Color
        ctx.lineWidth = 0.5;
        ctx.stroke();
      }
    }
  }

  requestAnimationFrame(render);
}

// Start rendering
render();


// Moving Line across bottom of header //

//  window.onload = function () {
//    document.querySelector('.moving-line').style.animation = 'moveLine 30s ease-in-out 1';
//  };

