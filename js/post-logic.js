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
