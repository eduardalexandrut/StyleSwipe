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
// Pin class.
class Pin {
    x;
    y;
    strokeStyle = "white";
    fillStyle = "#9013FE";
    lineWidth = 6;
    radius = 10;
    animationFrame;

    constructor(x, y) {
        this.x = x;
        this.y = y;
    };

    /*draw(ctx) {
        let startTime;
        const duration = 200; // Animation duration in milliseconds
        const targetRadius = this.radius;

        const animate = (timestamp) => {
            if (!startTime) startTime = timestamp;
            const progress = Math.min((timestamp - startTime) / duration, 1);
            const currentRadius = targetRadius * progress;

            ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);

            ctx.beginPath();
            ctx.arc(this.x, this.y, currentRadius, 0, 2 * Math.PI);
            ctx.strokeStyle = this.strokeStyle;
            ctx.fillStyle = this.fillStyle;
            ctx.lineWidth = this.lineWidth;
            ctx.stroke();
            ctx.fill();

            if (progress < 1 && currentRadius < targetRadius) {
                this.animationFrame = requestAnimationFrame(animate);
            }
        };

        this.animationFrame = requestAnimationFrame(animate);
    }

    stopAnimation() {
        cancelAnimationFrame(this.animationFrame);
    }*/
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

document.addEventListener('DOMContentLoaded', function () {

const postCanvas = document.querySelectorAll(".post > canvas");
const pinItem = new Map();
const randomPins = generateRandomPins();
const UPLOAD_DIR = "upload/";
let selectedPost;

if ( document.querySelector(".post") != null) {
    let offsetX = document.querySelector(".post").getBoundingClientRect().x;
    let offsetY = document.querySelector(".post").getBoundingClientRect().y;
    
    //Event listener to dynamically resize the canvas'.
    window.addEventListener("resize", ()=>{resizeCanvas()}, false);
}

postCanvas.forEach(elem => elem.addEventListener("click",(e)=>clickPost(elem, e.clientX, e.clientY), false));
postCanvas.forEach(elem => elem.setAttribute("data-selected", "false"));

//Event listener for buttons of class .like-btn.
document.querySelectorAll("button.like-btn").forEach((btn) => btn.addEventListener("click", ()=>likeUnlike(btn), false));

//Event listener for buttons of class .star-btn.
document.querySelectorAll("button.star-btn").forEach((btn) => btn.addEventListener("click", ()=>starUnstar(btn), false));

//Event listener for buttons of class .comment-btn.
document.querySelectorAll(".post button.comment-btn").forEach((btn) => btn.addEventListener("click", ()=>showComments(btn), false));

//Event listener for button to add a new comment.
document.getElementById("button-addon2").addEventListener("click", (e)=>addComment(e.target), false);

// Event listener for commentModal input when text is written in it.
document.querySelector("#commentsModal input[name='comment']").addEventListener("input", (e) => {
    let text = e.target.value;
    let addButton = document.querySelector("#commentsModal button#button-addon2");

    if (text.length > 0) {
        addButton.removeAttribute("disabled");
    } else {
        addButton.setAttribute("disabled", true);
    }
}, false);

//Function to draw the pins relative to a post image(or hide them).
function drawPins(canvas) {
    let ctx = canvas.getContext("2d");
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    if (canvas.getAttribute("data-selected") == "true"){
        pinItem.forEach((v,k) => {
            k.draw(ctx);
        });
    } 
}

//Function that draws the pins of an image and sets the selected state of the canvas.
function clickPost(canvas, x, y) {
    if(canvas.getAttribute("data-selected") == "false") {
        setSelected(canvas);
        getItems(canvas);
    } else {
        let clickedItem = detectCollision(canvas, x, y);
        if (clickedItem != null) {
            //Set the input fields based on the clickedItem data.
            setFields(clickedItem);
            new bootstrap.Modal(document.getElementById('itemInfoModal')).show();
        } else {
            console.log("no");
            setSelected(canvas);
            getItems(canvas);
        }
    }
    /*setSelected(canvas);
    getItems(canvas);*/
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

//Function to resize all the canvas and keep pins' positions the same relative to the change in size.
function resizeCanvas(canvasList) {
    let imgW = document.querySelector(".post > img");
    let oldWidth = postCanvas[0].width;
    let oldHeight = postCanvas[0].height;

    //Change pins x,y.
    pinItem.forEach((v,k) => {
        k.x = k.x * (imgW.width/oldWidth);
        k.y = k.y * (imgW.height/oldHeight);
    })

    //Reset canvas width/height
    postCanvas.forEach((elem) => {
        elem.width = imgW.width;
        elem.height = imgW.height; 
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

//Function to add/remove a like.
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
        //console.log(data); // Log the response for debugging.

        // If button was a like, now set action to unlike.
        if (action == "LIKE") {
            btn.setAttribute("data-action", "UNLIKE");
            btn.querySelector("i").classList.remove("bi-hand-thumbs-up");
            btn.querySelector("i").classList.add("class", "bi-hand-thumbs-down");
            btn.nextElementSibling.textContent = parseInt(btn.nextElementSibling.textContent) + 1;
            
        } else {
            btn.setAttribute("data-action", "LIKE");
            btn.querySelector("i").classList.remove("bi-hand-thumbs-down");
            btn.querySelector("i").classList.add("class", "bi-hand-thumbs-up");
            btn.nextElementSibling.textContent = parseInt(btn.nextElementSibling.textContent) - 1;
        }
    })
    .catch(error => console.error('Error:', error));
    }

//Function to add/remove a star.
function starUnstar(btn) {
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
        // If button was a star, now set action to unstar.
        if (action == "STAR") {
            btn.setAttribute("data-action", "UNSTAR");
            btn.querySelector("i").classList.remove("bi-star");
            btn.querySelector("i").classList.add("class", "bi-star-fill");
            btn.nextElementSibling.textContent = parseInt(btn.nextElementSibling.textContent) + 1;
            
        } else {
            btn.setAttribute("data-action", "STAR");
            btn.querySelector("i").classList.remove("bi-star-fill");
            btn.querySelector("i").classList.add("class", "bi-star");
            btn.nextElementSibling.textContent = parseInt(btn.nextElementSibling.textContent) - 1;
        }
    })
    .catch(error => console.error('Error:', error));
    }

    //Function to show the comments of a specific post.
    function showComments(btn) {
        let postId = btn.getAttribute("data-post-id");
        selectedPost = postId;

        //GET requests to get the comments of the specific post.
        fetch(`./home.php?postId=${postId}&action=COMMENTS`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error("Network response was not ok");
            }
        })
        .then(data => {
            let modalBody = document.querySelector("#commentsModal .modal-body");

            //Remove all previous elements from the modal-body.
            modalBody.innerHTML = '';

            if (data.comments.length == 0) {
                modalBody.innerHTML = '<p>No comments yet.</p>';
            } else {
                data.comments.forEach((comment) => {
                    let commentDiv = document.createElement('div');
                    commentDiv.classList.add("comment");
                    commentDiv.innerHTML = `
                    <img alt="User Profile Pic" src="${UPLOAD_DIR}${comment['profile_image']}"/>
                        <section>
                            <header> 
                                <a href="profile.html">${comment['user_username']}</a>
                                <p>${calculate_days(comment['date_posted'])}</p>
                            </header>
                            <p>${comment['comment_text']}</p>
                        </section>
                    `
                    modalBody.appendChild(commentDiv);
                });
            }
        })
        .catch(error => console.error('Error:', error));
    }

    //Function to add a new comment.
    function addComment(btn) {
        let action = btn.getAttribute("data-action");
        let comment_text = document.querySelector("#commentsModal .modal-footer input").value;
        let postId = selectedPost;

        fetch('./home.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                action: action,
                postId: postId,
                comment_text: comment_text
            })
        })
        .then(response => {
            if (response.ok) {
                return response.text(); 
            } else {
                throw new Error("Network response was not ok");
            }
        })
        .then(data => {
            //Erase input's content.
            document.querySelector("#commentsModal .modal-footer input").value = '';
            //Increase number of comments displayed under the comments button.
            let prevNumComm = parseInt(document.querySelector(`div.post[data-post-id="${selectedPost}"] button.comment-btn`).nextElementSibling.innerHTML);
            document.querySelector(`div.post[data-post-id="${selectedPost}"] button.comment-btn`).nextElementSibling.innerHTML = prevNumComm + 1;
        })
        .catch(error =>console.log('Error:', error));
        
    }

        
    //Function to get the items of a post.
    function getItems(canvas) {
        let postId = canvas.getAttribute("data-post-id");
        let action = "ITEMS";
        pinItem.clear();//Clear pinItem.

        fetch(`./home.php?postId=${postId}&action=${action}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then((response) =>{
            if (response.ok) {
                return response.json();
            } else {
                throw new Error("Network response was not ok");
            }
        })
        .then(data => {
            //Add to the map an entry (pin, item).
            data.items.forEach(item => {
                const newItem = new Item(
                        item.name,
                        item.brand,
                        item.link,
                        item.price,
                        item.size,
                        item.x,
                        item.y
                        );
                        
                        const newPin = new Pin(item.x, item.y, newItem);
                        pinItem.set(newPin, newItem);
                    });
                    //console.log(pinItem);
                    drawPins(canvas);
                    console.log(pinItem);
                })
        .catch(error => console.error('Error:', error));
    }
    
    //Function to calculate days passed between 2 days.
    function calculate_days(date) {
        let startDate = new Date(date);

        let currentDate = new Date();

        //Number of milliseconds passed.
        let timePassed = currentDate - startDate;

        let numOfDays = Math.floor(timePassed/(1000 *60 * 60 * 24));

        if (numOfDays < 1) {
            return 'Today';
        } else if (numOfDays == 1) {
            return `${numOfDays} day ago.`;
        } else {
            return `${numOfDays} days ago.`;
        }

    }

    //Function to detect if a user clicked on a pin.
    function detectCollision(canvas, x, y) {
        let clickX = x - canvas.getBoundingClientRect().x;
        let clickY = y - canvas.getBoundingClientRect().y;

        //Loop trough pins and check if the click is within the boundaries of a pin.
        for (const [pin, item] of pinItem.entries()) {
            if (inBoundaries(pin, clickX, clickY)) {
                return item;
            }
        }
        return null;

    }

    //Function to check if a click is within the boundaries of a pin.
    function inBoundaries(pin, x, y) {
        let pinX = pin.x;
        let pinY = pin.y;

        //Get the distance between the click and the center of the pin.
        distance = Math.sqrt(Math.pow(x - pinX, 2) + Math.pow(y - pinY, 2));
        console.log(distance, pin.radius);

        //Check distance.
        if (distance <= pin.radius * 1.8) {
            return true;
        } else {
            return false;
        }
    }

    //Function to set the input fields based on an intem's data.
    function setFields(item) {
        document.querySelector("input#itemName").value = item.getName();
        document.querySelector("input#itemBrand").value = item.getBrand();
        document.querySelector("input#itemLink").value = item.getLink();
        document.querySelector("input#itemSize").value = item.getSize();
        document.querySelector("input#itemPrice").value = item.getPrice();
    }
    if ( document.querySelector(".post") != null){
        resizeCanvas();
    }

});