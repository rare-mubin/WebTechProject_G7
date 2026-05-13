<!DOCTYPE html>
<html lang="en">
<head>
    <title>Rooms</title>
</head>

<body>

<div class="main">

    <!-- LEFT SIDE -->
    <div class="rooms-card">

        <!-- TOP BAR -->
        <div class="top-bar">

            <h2>Rooms</h2>

            <div class="filter-box">

                <select>
                    <option>All Type</option>
                </select>

                <select>
                    <option>All Status</option>
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
            <div>Status</div>

        </div>

        <!-- ROOM -->
        <div class="room-row">

            <div class="room-left">

                <div class="room-img">
                    <img src="../Image/room1.jpg" alt="">
                </div>

                <div class="room-details">

                    <span>ID:B17 • Room:101</span>
                    <span>1st Floor</span>

                    <h4>
                        Luxury Queen Bed <br>
                        With Garden View
                    </h4>

                </div>

            </div>

            <div class="description">

                Elegant modern room with premium
                lighting, swimming pool access
                and luxury interior decoration.

            </div>

            <div class="rate">
                $1280/Night
            </div>

            <div class="capacity">

                2 Adults <br>
                1 Child

            </div>

            <div class="amenities">

                WiFi, AC, TV

            </div>

            <div class="status green">
                Available
            </div>

        </div>

    </div>

    <!-- RIGHT SIDE -->
    <div class="add-room-card">

        <h2>Add Room</h2>

        <!-- ROOM ID -->
        <div class="input-box">

            <label>Room ID</label>

            <input type="text" placeholder="B17">

        </div>

        <!-- ROOM TYPE -->
        <div class="input-box">

            <label>Room Type</label>

            <select>
                <option>Standard</option>
                <option>Delux</option>
                <option>Suite</option>
            </select>

        </div>

        <!-- ROOM NUMBER -->
        <div class="input-box">

            <label>Room Number</label>

            <input type="text" placeholder="101">

        </div>

        <!-- FLOOR NUMBER -->
        <div class="input-box">

            <label>Floor Number</label>

            <input type="text" placeholder="1st Floor">

        </div>

        <!-- RATE -->
        <div class="input-box">

            <label>Rate Per Night</label>

            <input type="text" placeholder="$1200 / Night">

        </div>

        <!-- MAX CAPACITY -->
        <div class="input-box">

            <label>Max Capacity</label>

            <input type="text" placeholder="2 Adults, 1 Child">

        </div>

        <!-- AMENITIES -->
        <div>

            <label>Amenities</label>

            <div class="checkbox-group">

                <label class="check-item">

                    <input type="checkbox">

                    <span>WiFi</span>

                </label>

                <label class="check-item">

                    <input type="checkbox">

                    <span>AC</span>

                </label>

                <label class="check-item">

                    <input type="checkbox">

                    <span>TV</span>

                </label>

            </div>

        </div>

        <!-- IMAGE -->
        <div class="input-box">

            <label>Room Image</label>

            <div class="upload-box">

                <i class="fa-regular fa-image"></i>

                <p>Click to Upload or drag and drop</p>

                <span>(Max file size 25 MB)</span>

            </div>

        </div>

        <!-- BUTTON -->
        <div class="btn-box">

            <button class="add-btn">
                Add Room
            </button>

        </div>

    </div>

</div>

</body>
</html>