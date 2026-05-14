<!DOCTYPE html>
<html lang="en">
<head>

    <title>Rooms</title>
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* rooms.css */

/* RESET */

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, Helvetica, sans-serif;
}


/* MAIN */

.main{
    display:flex;
    gap:25px;
    align-items:flex-start;
}

/* LEFT CARD */

.rooms-card{
    flex:1;
    background:#fff;
    border-radius:20px;
    padding:25px;
    box-shadow:0 2px 12px rgba(0,0,0,0.05);
}

/* TOP BAR */

.top-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.top-bar h2{
    font-size:26px;
    color:#222;
}

/* FILTER */

.filter-box{
    display:flex;
    gap:12px;
}

.filter-box select{
    min-width:130px;
    height:42px;
    border:1px solid #dfe3ea;
    border-radius:10px;
    padding:0 15px;
    outline:none;
    background:#fff;
    color:#555;
    font-size:14px;
    cursor:pointer;
}

/* TABLE HEAD */

.table-head{
    display:grid;

    grid-template-columns:
    2.8fr
    1.2fr
    1.2fr
    1.4fr
    1fr
    0.8fr;

    gap:20px;

    padding-bottom:16px;

    border-bottom:1px solid #ececec;

    color:#666;
    font-size:14px;
    font-weight:600;
}

/* ROOM ROW */

.room-row{
    display:grid;

    grid-template-columns:
    2.8fr
    1.2fr
    1.2fr
    1.4fr
    1fr
    0.8fr;

    gap:20px;

    align-items:center;

    padding:22px 0;
    border-bottom:1px solid #f0f2f5;
}

.room-row:last-child{
    border-bottom:none;
}

/* ROOM LEFT */

.room-left{
    display:flex;
    align-items:center;
    gap:15px;
}

/* IMAGE */

.room-img{
    width:110px;
    height:78px;
    border-radius:14px;
    overflow:hidden;
    flex-shrink:0;
}

.room-img img{
    width:100%;
    height:100%;
    object-fit:cover;
    display:block;
}

/* DETAILS */

.room-details span{
    display:block;
    font-size:12px;
    color:#8b8b8b;
    margin-bottom:4px;
}

.room-details h4{
    font-size:15px;
    color:#222;
    line-height:22px;
    margin-top:5px;
}

/* RATE */

.rate{
    font-size:14px;
    font-weight:600;
    color:#222;
}

/* CAPACITY */

.capacity{
    font-size:13px;
    line-height:22px;
    color:#555;
}

/* AMENITIES */

.amenities{
    font-size:13px;
    line-height:22px;
    color:#555;
}

/* STATUS */

.status{
    width:max-content;
    border-radius:30px;
    padding:8px 13px;
    font-size:12px;
    font-weight:700;
}

.green{
    background:#eafaf1;
    color:#20b761;
}

.yellow{
    background:#fff7e1;
    color:#d79a00;
}

.red{
    background:#ffecec;
    color:#e23c3c;
}

/* ACTION */

.action{
    display:flex;
    align-items:center;
}

.delete-btn{
    width:38px;
    height:38px;
    border:none;
    border-radius:12px;
    background:#fff0f0;
    color:#ff3b3b;
    font-size:15px;
    cursor:pointer;
    transition:0.3s;
}

.delete-btn:hover{
    background:#ff3b3b;
    color:#fff;
}

/* RIGHT CARD */

.add-room-card{
    width:360px;
    background:#fff;
    border-radius:20px;
    padding:25px;
    box-shadow:0 2px 12px rgba(0,0,0,0.05);
}

/* TITLE */

.add-room-card h2{
    font-size:26px;
    color:#222;
    margin-bottom:25px;
}

/* INPUT BOX */

.input-box{
    margin-bottom:22px;
}

.input-box label{
    display:block;
    margin-bottom:10px;
    font-size:14px;
    color:#555;
    font-weight:600;
}

/* INPUT */

.input-box input,
.input-box select{
    width:100%;
    height:48px;
    border:1px solid #dfe3ea;
    border-radius:12px;
    padding:0 15px;
    outline:none;
    font-size:14px;
    background:#fff;
    color:#555;
}

/* BUTTON */

.btn-box{
    margin-top:28px;
}

.add-btn{
    width:100%;
    height:50px;
    border:none;
    border-radius:12px;
    background:#3563ff;
    color:#fff;
    font-size:15px;
    font-weight:600;
    cursor:pointer;
    transition:0.3s;
}

.add-btn:hover{
    background:#234de0;
}

    </style>
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
