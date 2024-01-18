<main id="createMain">
    <h1>New Outfit</h1>
    <div>
        <!--Image Picker-->
                        <div>
                            <section>
                                <input title="Image File" type="file" accept="image/*" class="d-none" id="selectedFile" />
                                <input title="Button File" type="button" value="Select Photo +"  onclick="document.getElementById('selectedFile').click();" />
                            </section>
                        </div>
                        <!--Items-->
                        <h2>Items</h2>
                        <div id="itemContainer">
                            
                        </div>
                    </div>
                </main><aside id="createAside">
                    <section>
                        <img src="<?php echo UPLOAD_DIR.$templateParams["profilepic"]; ?>" alt=""/>
                        <ul>
                            <li>@<?php echo $templateParams["username"]?></li>
                            <li><p id="dateTime"></p></li>
                        </ul> 
                    </section>
                    <form id = "createForm" action="create.php" method="post" >
                        <textarea title="comment" name="comment" placeholder="Add a description of your outfit..." maxlength="250"></textarea>
                        <input  type="submit" value="Add Post"/>
                        <input  type="button" value="Discard"/>
                    </form>
                </aside>
                <!--Add Item Modal-->
                <div class="modal fade" id="addItemModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h3>Component Info</h3>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="itemName" type="text"  name="link" placeholder="Name"/>
                                    <label for="itemName">Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="itemBrand" type="text"  name="link" placeholder="Brand"/>
                                    <label for="itemBrand">Brand</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="itemLink" type="text"  name="link" placeholder="Link"/>
                                    <label for="itemLink">Link</label>
                                </div>
                                <div class="row">
                                    <div class="form-floating mb-3 col-6">
                                        <input class="form-control" id="itemPrice" type="text"  name="link" placeholder="Price"/>
                                        <label for="itemPrice">Price</label>
                                    </div>
                                    <div class="form-floating mb-3 col-6">
                                        <input class="form-control" id="itemSize" type="text" name="link" placeholder="Size"/>
                                        <label for="itemSize">Size</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input id="addPinBtn" type="button" data-bs-dismiss="modal"   value="Add"/>
                                    <input type="button" data-bs-dismiss="modal"  value="Discard">
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>

                 <!--Notifications Modal-->
                <div class="modal fade" id="notifyModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class=" modal-content">
                            <div class="modal-header">
                                <h2>Notifications</h2>
                                <button data-bs-dismiss="modal">
                                    <i class="bi-x-circle"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <button class="refresh-notify">
                                    Refresh +
                                </button>
                                <div class="notifyContainer">
               
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php require("template/search.html"); ?>

<script src="js/open-search.js"></script>             
<script  src="js/create-view.js"></script>
<script  src="js/Item.js"></script>
<script  src="js/Pin.js"></script>
<script  src="js/notifications.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>