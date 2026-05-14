<!DOCTYPE html>
<html lang="en">
<head>

    <title>Rooms Type</title>

    <link rel="stylesheet" href="../styles/Roomtype.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<div class="main">

    <!-- LEFT SIDE -->
    <div class="rooms-card">

        <!-- TOP BAR -->
        <div class="top-bar">

            <h2>Rooms Type</h2>

            <div class="filter-box">

                <select>
                    <option>All Type</option>
                </select>

            </div>

        </div>

        <!-- TABLE HEAD -->
        <div class="table-head">

            <div>Image</div>
            <div>Description</div>
            <div>Rate</div>
            <div>Capacity</div>
            <div>Amenities</div>
            <div>Action</div>

        </div>

        <!-- ROOM -->
        <div class="room-row">

            <!-- IMAGE + DETAILS -->
            <div class="room-left">

                <div class="room-img">

                    <img src="../Image/room1.jpg" alt="">

                </div>

                <div class="room-details">

                    <span>ID:B17 </span>


                    <h4>
                        Luxury Queen Bed <br>
                        With Garden View
                    </h4>

                </div>

            </div>

            <!-- DESCRIPTION -->
            <div class="description">

                Elegant modern room with luxury
                lighting, pool access and premium
                interior decoration.

            </div>

            <!-- RATE -->
            <div class="rate">

                $1280/Night

            </div>

            <!-- CAPACITY -->
            <div class="capacity">

                2 Adults <br>
                1 Child

            </div>

            <!-- AMENITIES -->
            <div class="amenities">

                WiFi, AC, TV

            </div>

            <!-- ACTION -->
            <div class="action">

                <button class="delete-btn" type="button" title="Delete Room">

                    <i class="fa-solid fa-trash"></i>

                </button>

            </div>

        </div>

    </div>

    <!-- RIGHT SIDE -->
    <div class="add-room-card">

        <h2>Add Room Type</h2>

        <!-- ROOM TYPE -->
        <div class="input-box">

            <label>Room Type Name</label>

            <input type="text" >

        </div>

        <!-- RATE -->
        <div class="input-box">

            <label>Per Night Rate</label>

            <input type="text" placeholder="">

        </div>

        <!-- DESCRIPTION -->
        <div class="input-box">

            <label>Description</label>

            <textarea placeholder="Write room description..."></textarea>

        </div>

        <!-- MAX CAPACITY -->
        <div class="input-box">

            <label>Max Capacity</label>

            <input type="text" >

        </div>

        <!-- AMENITIES -->
        <div class="input-box">

            <label>Amenities</label>

            <div class="amenities-box">

                <label class="amenity-item">
                    <input type="checkbox">
                    <span>WiFi</span>
                </label>

                <label class="amenity-item">
                    <input type="checkbox">
                    <span>Air Condition</span>
                </label>

                <label class="amenity-item">
                    <input type="checkbox">
                    <span>Smart TV</span>
                </label>

                <label class="amenity-item">
                    <input type="checkbox">
                    <span>Breakfast</span>
                </label>

            </div>

        </div>

        <!-- ROOM IMAGE -->
        <div class="input-box">

            <label>Room Image</label>

            <div class="upload-box">

                <i class="fa-regular fa-image"></i>

                <p>Click to Upload or drag and drop</p>

                <span>Max file size 25 MB</span>

            </div>

        </div>

        <!-- BUTTON -->
        <div class="btn-box">

            <button class="add-btn">

                Add Room Type

            </button>

        </div>

    </div>

</div>



</body>
</html>
