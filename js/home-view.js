//Item class.
class Item {
    constructor(name, brand, link, price, size, x, y) {
        this.name = name;
        this.brand = brand;
        this.link = link;
        this.price = price;
        this.size = size;
        this.x = x;
        this.y = y;
    }

    // Getters
    getName() {
        return this.name;
    }

    getBrand() {
        return this.brand;
    }

    getLink() {
        return this.link;
    }

    getPrice() {
        return this.price;
    }

    getSize() {
        return this.size;
    }

    getX() {
        return this.x;
    }

    getY() {
        return this.y;
    }
}

//Pin class.
class Pin {
    x;
    y;
    strokeStyle = "white";
    fillStyle = "#9013FE";
    lineWidth = 6;
    radius = 8;
    
    constructor(x, y) {
        this.x = x;
        this.y = y;
    };
    
    draw(ctx) {
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.radius, 0 , 2*Math.PI);
        ctx.strokeStyle=this.strokeStyle;
        ctx.fillStyle = this.fillStyle;
        ctx.lineWidth = this.lineWidth;
        ctx.stroke();
        ctx.fill();
    }
};

document.addEventListener('DOMContentLoaded', function () {const postCanvas = document.querySelectorAll(".post > canvas");
const randomPins = generateRandomPins();
let offsetX = document.querySelector(".post").getBoundingClientRect().x;
let offsetY = document.querySelector(".post").getBoundingClientRect().y;

postCanvas.forEach(elem => elem.addEventListener("click",(e)=>clickPost(elem), false));
postCanvas.forEach(elem => elem.setAttribute("data-selected", "false"));

//Event listener to dynamically resize the canvas'.
window.addEventListener("resize", ()=>{resizeCanvas()}, false);

//Event listener for buttons of class .like-btn.
document.querySelectorAll("button.like-btn").forEach((btn) => btn.addEventListener("click", ()=>likeUnlike(btn), false));
//Function to draw the pins relative to a post image(or hide them).
function drawPins(canvas) {
    let ctx = canvas.getContext("2d");
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    if (canvas.getAttribute("data-selected") == "true"){
        randomPins.forEach((elem) => elem.draw(ctx));
    } 
}

//Function that draws the pins of an image and sets the selected state of the canvas.
function clickPost(canvas) {
    setSelected(canvas);
    drawPins(canvas);
}

//Function to open an itemo info modal when a certain item gets clicked on the image of a post.
function openInfoModal(elem) {
    elem.setAttribute("data-bs-toggle", "modal");
    elem.setAttribute("data-bs-target", "#itemInfoModal");
}

//Function to set a clicked canvas to selected or not.
function setSelected(canvas) {
    if(canvas.getAttribute("data-selected") == "false") {
        canvas.setAttribute("data-selected", "true");
    } else {
        canvas.setAttribute("data-selected", "false");
    }
}

//Function to resize all the canvas'.
function resizeCanvas(canvasList) {
    let imgW = document.querySelector(".post > img").width;
    postCanvas.forEach((elem) => {
        elem.width = imgW;
        elem.height = imgW; 
        if (elem.getAttribute("data-selected") == "true"){
            drawPins(elem);
        }
    });
}

//Function to detect if a pin gets clicked. 

//Function to generate 10 random posts.
function generateRandomPins() {
    const pins = [];
    const canvasWidth = 300; // Maximum x coordinate
    const canvasHeight = 300; // Maximum y coordinate

    // Create 10 pins with random x, y coordinates
    for (let i = 0; i < 10; i++) {
        /*const randomX = Math.floor(Math.random() * (canvasWidth - 10)); // Random x coordinate
        const randomY = Math.floor(Math.random() * (canvasHeight - 10)); // Random y coordinate

        // Create Pin objects and add them to the array
        const pin = new Pin(randomX, randomY /* pass your canvas context here );*/
        const pin = new Pin(i * 20, i * 20);
        pins.push(pin);
    }

    return pins;
}

//Function to add a like.
function likeUnlike(btn) {
    let postId = btn.getAttribute("data-post-id");
    let action = btn.getAttribute("data-action");
    console.log(action , postId)
    //Send data to home.php.
    fetch('./home.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            action: action,
            postId: postId
        })
    })
    .then(response => {
        if (response.ok) {
            return response.text(); // Parse the JSON from the response.
        } else {
            throw new Error("Network response was not ok");
        }
    })
    .then(data => {
        // Handle the JSON response.
        console.log(data); // Log the response for debugging.

        // If button was a like, now set action to unlike.
        if (action == "LIKE") {
            btn.setAttribute("data-action", "UNLIKE");
            
        } else {
            btn.setAttribute("data-action", "LIKE");
        }
    })
    .catch(error => console.error('Error:', error));
    }

resizeCanvas();
});