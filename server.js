const express = require('express');
const { spawn } = require('child_process');
const path = require('path');
const app = express();

// Set port dari environment atau default 3000
const port = process.env.PORT || 3000;

// Serve static files dari public directory Laravel
app.use(express.static(path.join(__dirname, 'public')));

// Proxy semua request ke Laravel
app.get('*', (req, res) => {
    // Redirect ke Laravel's public/index.php
    res.sendFile(path.join(__dirname, 'public', 'index.php'));
});

app.listen(port, () => {
    console.log(`Server running on port ${port}`);
});
