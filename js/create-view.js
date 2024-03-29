document.addEventListener('DOMContentLoaded', function () {

        let offsetX;
        let offsetY;
        let clientX;
        let clientY;
        const items = [];
        const pins = [];
        const itemContainer = document.querySelector("#itemContainer");
        let itemDivs = itemContainer.querySelectorAll(".item");
        const imgInput = document.getElementById('selectedFile');
        const image = document.createElement('img');
        const canvas = document.createElement('canvas');
        let ctx = canvas.getContext("2d");
        
        //reset offest when the window gets resized.
        window.addEventListener("resize", ()=>setOffset(), false);

        //Image picker.
        //document.querySelector("section:first-of-type > input:first-of-type").addEventListener("change", ()=>previewImg(), false);
        document.getElementById('selectedFile').addEventListener("change", () => previewImg(), false);


        //Event when the forme gets submitted.
        document.getElementById("createForm").addEventListener("submit", (e)=>sendItemsToDB(e), false);

        //Discard button event.
        document.querySelector("#createForm > input[value='Discard']").addEventListener("click", ()=>window.location.href = 'home.php', false);

            // Find the addPinBtn element
            let addPinBtn = document.getElementById('addPinBtn');
        
            // Check if the element exists
            if (addPinBtn) {
                // Add the event listener
                addPinBtn.addEventListener('click', createItem);
            }
            
            
            /*Function to create a displayable image selected by the user.*/
            function previewImg() {
            let [file] = imgInput.files;
            if (file) {
                image.src = URL.createObjectURL(file);
                document.querySelector("#createMain section:first-of-type").style = "display: grid; grid-template-row: 500px;grid-template-column: 100%; border:none !important";
                document.querySelector("main#createMain  section:first-of-type").appendChild(image);
                canvas.addEventListener("click", (e)=>{setClientCo(e);}, false);
                canvas.setAttribute("data-bs-toggle","modal");
                canvas.setAttribute("data-bs-target","#addItemModal");
                canvas.setAttribute("width", "380");
                canvas.setAttribute("height","500");
                document.querySelector("main#createMain section:first-of-type").appendChild(canvas);
                document.querySelector("main#createMain  section:first-of-type input[type='button']").style="display:none;"
            }
            
        }
        
        
        //Function to set x and y.
        function setClientCo(e) {
            clientX = e.clientX;
            clientY = e.clientY;
        }

        //Function to change the offsetX, offsetY variables.
        function setOffset() {
            offsetX = document.querySelector("#createMain section:first-of-type").getBoundingClientRect().x;
            offsetY = document.querySelector("#createMain section:first-of-type").getBoundingClientRect().y;
            console.log("offset.",offsetX, offsetY);
            if(document.querySelector("#createMain div div section img") != null) {
                let oldWidth = canvas.width;
                let oldHeight = canvas.height;
                //canvas.width = document.querySelector("#createMain div div section img").width;
                //canvas.height = document.querySelector("#createMain div div section img").height;
                Array.from(pins).forEach((pin) =>pin.draw(ctx));
                /*Array.from(pins).forEach((pin) => {
                    let newX = pin.x * (canvas.width/oldWidth);
                    let newY = pin.y * (canvas.height/oldHeight);

                    pin.x = pin.x * (canvas.width/oldWidth);
                    pin.y = pin.y * (canvas.height/oldHeight);
                    pin.draw(ctx);
                });*/
            }
        }

        //Function to create an Item object.
        function createItem() {
            let iName = document.querySelector(".modal#addItemModal  input#itemName").value;
            let iBrand = document.querySelector(".modal#addItemModal  input#itemBrand").value;
            let iLink = document.querySelector(".modal#addItemModal  input#itemLink").value;
            let iSize = document.querySelector(".modal#addItemModal  input#itemSize").value;
            let iPrice= document.querySelector(".modal#addItemModal  input#itemPrice").value;
            let item = `
            <div class="item">
                                <div>
                                    <div class="form-floating mb-3">
                                    <input class="form-control" value="${iName}" id="itemName" type="text"  name="link" placeholder="Name" readonly/>
                                        <label for="itemName">Name</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                    <input class="form-control" id="itemBrand" value="${iBrand}" type="text"  name="link" placeholder="Brand" readonly/>
                                    <label for="itemBrand">Brand</label>
                                    </div>
                                </div>                  
                                <div class="form-floating mb-3">
                                <input class="form-control" id="Link" type="text" value="${iLink}"  name="link" placeholder="Link" readonly/>
                                <label for="itemLink">Link</label>
                                </div>
                                <div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="Price" type="text" value="${iPrice}"  name="link" placeholder="Price" readonly/>
                                        <label for="itemPrice">Price</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                    <input class="form-control" id="Size" type="text" value="${iSize}" name="link" placeholder="Size" readonly/>
                                    <label for="itemSize">Size</label>
                                    </div>
                                    </div>
                                    <div style="text-align:center">
                                    <button class="trashBtn">
                                        <i class="bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>`;
            itemContainer.innerHTML = itemContainer.innerHTML + item;
            itemDivs = itemContainer.querySelectorAll(".item");

            Array.from(itemDivs).forEach((item) => item.querySelector(".trashBtn").addEventListener("click", ()=>removeItem(item, Array.from(itemDivs).indexOf(item))))
            items.push(new Item(iName, iBrand, iLink, iSize, iPrice, clientX - offsetX, clientY - offsetY));
            console.log(items);
            createPin();
        }

        //Function to create a Pin object and draw it on the canvas.
        function createPin() {
            setOffset();
            pins.push(new Pin(clientX - offsetX, clientY - offsetY));
            console.log(pins);
            console.log(clientX, clientY)
            
            Array.from(pins).forEach((pin) => pin.draw(ctx));
        }
        
        //Function to remove an item from the DOM and the list.
        function removeItem(item, index) {
            let xToRemove = items[index].getX();
            let yToRemove = items[index].getY();
            //remove item div.
            itemContainer.removeChild(item);
            
            //Remove pin.
            let pinToRemove = Array.from(pins).filter((pin) => pin.x === xToRemove && pin.y === yToRemove);
            let indexPin = Array.from(pins).indexOf(pinToRemove);
            
            //remove item object an pin.
            if (index > -1) {
                items.splice(index, 1);
                pins.splice(indexPin, 1);
            }
            console.log(pins);
            
            //redraw canvas.
            ctx.clearRect(0,0, canvas.width, canvas.height);
            
            //redraw pins.
            Array.from(pins).forEach((pin) => pin.draw(ctx));
        }
        
        /*Code to inject current date in #dateTime*/
        let now = new Date();
        let date = now.toLocaleString();
        document.getElementById("dateTime").innerHTML = ` ${now.getDay()} ${now.getMonth() + 1} ${now.getFullYear()}`;

        //Function to send the json representation of the items to the db and create them.
        function sendItemsToDB(event) {
            // Append the items to the post data.
            let formData = new FormData(event.target);
            formData.append('items', JSON.stringify(items));

            // Append the image file from the input field
            formData.append('image', imgInput.files[0]);
        
            fetch('./create.php', {
                method: 'POST',
                body: formData,
            })
            .then(
                response =>{
                    if (response.ok) {
                        //If ok, redirect to home.php
                        window.location.href="home.php"
                    } else {
                        console.error('Error:', response.status);
                    }
                }
            )
            .catch(error => console.error('Error:', error));
        
            event.preventDefault();
        }

        //Function to recalculate pins x and y when the image gets resized.
        
        setOffset();
    });