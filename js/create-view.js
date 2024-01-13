    import './Item.js';
    import './Pin.js';
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

        document.querySelector("section:first-of-type > input:first-of-type").addEventListener("change", ()=>previewImg(), false);
        
        /*Function to create a displayable image selected by the user.*/
        function previewImg() {
            let [file] = imgInput.files;
            if (file) {
                image.src = URL.createObjectURL(file);
                document.querySelector("#createMain section:first-of-type").style = "display: grid; grid-template-row: 500px;grid-template-column: 100%";
                document.querySelector("main#createMain  section:first-of-type").appendChild(image);
                canvas.addEventListener("click", (e)=>{setClientCo(e);}/*addCircle(e.clientX, e.clientY, offsetX, offsetY)*/, false);
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
                                        <input class="form-control" id="itemBrand" value="${iPrice}" type="text"  name="link" placeholder="Brand" readonly/>
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
                                <div>
                                    <button class="eyeBtn">
                                        <i class="bi-eye"></i>
                                    </button>
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
            pins[pins.length - 1].draw(ctx);
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
        document.getElementById("dateTime").innerHTML = date;

        setOffset();