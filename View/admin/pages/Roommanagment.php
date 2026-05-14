<!DOCTYPE html>
<html lang="en">
<head>

    <title>Rooms</title>

    <link rel="stylesheet" href="../styles/Rooms.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<div class="main">

    <div class="rooms-card">

        <div class="top-bar">

            <h2>Rooms</h2>

            <div class="filter-box">

                <select>
                    <option>All Type</option>
                    <option>Luxury Suite</option>
                    <option>Deluxe Room</option>
                    <option>Family Room</option>
                </select>

                <select>
                    <option>All Status</option>
                    <option>Available</option>
                    <option>Booked</option>
                    <option>Maintenance</option>
                </select>

            </div>

        </div>

        <div class="table-head">

            <div>Image</div>
            <div>Rate</div>
            <div>Capacity</div>
            <div>Amenities</div>
            <div>Status</div>
            <div>Action</div>

        </div>

        <div class="room-row">

            <div class="room-left">

                <div class="room-img">

                    <img src="../Image/room1.jpg" alt="">

                </div>

                <div class="room-details">

                    <span>Room: 101</span>

                    <span>1st Floor</span>

                    <h4>
                        Luxury Queen Bed <br>
                        With Garden View
                    </h4>

                </div>

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

            <div class="action">

                <button class="delete-btn" type="button" title="Delete Room">

                    <i class="fa-solid fa-trash"></i>

                </button>

            </div>

        </div>

    </div>

    <div class="add-room-card">

        <h2>Add Room</h2>

        <div class="input-box">

            <label>Room Type</label>

            <select>
                <option>Select Room Type</option>
                <option>Luxury Suite</option>
                <option>Deluxe Room</option>
                <option>Family Room</option>
            </select>

        </div>

        <div class="input-box">

            <label>Room Number</label>

            <input type="text" placeholder="101">

        </div>

        <div class="input-box">

            <label>Floor</label>

            <input type="text" placeholder="1st Floor">

        </div>

        <div class="input-box">

            <label>Per Night Rate</label>

            <input type="text" placeholder="$1200 / Night">

        </div>

       

        <div class="btn-box">

            <button class="add-btn">

                Add Room

            </button>

        </div>

    </div>

</div>


</body>
</html>
