<!DOCTYPE html>
<html lang="en">
<head>

    <title>Rooms Type</title>

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* roomtype css */

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

.filter-box select{
    width:140px;
    height:42px;
    border:1px solid #dfe3ea;
    border-radius:10px;
    padding:0 15px;
    outline:none;
    background:#fff;
    color:#555;
    font-size:14px;
}

/* TABLE HEAD */

.table-head{
    display:grid;
    grid-template-columns: 2.8fr 2fr 1fr 1fr 1fr 0.8fr;
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
    grid-template-columns: 2.8fr 2fr 1fr 1fr 1fr 0.8fr;
    gap:20px;
    align-items:center;
    padding-top:22px;
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

/* DESCRIPTION */

.description{
    font-size:13px;
    line-height:22px;
    color:#666;
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
    width:380px;
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
textarea{
    width:100%;
    border:1px solid #dfe3ea;
    border-radius:12px;
    padding:14px 15px;
    outline:none;
    font-size:14px;
    background:#fff;
}

/* TEXTAREA */

textarea{
    height:110px;
    resize:none;
}

/* AMENITIES BOX */

.amenities-box{
    display:flex;
    flex-wrap:wrap;
    gap:12px;
}

/* ITEM */

.amenity-item{
    display:flex;
    align-items:center;
    gap:7px;
    background:#f5f7fb;
    border:1px solid #e2e7f0;
    border-radius:30px;
    padding:8px 14px;
    cursor:pointer;
}

/* SMALL CHECKBOX */

.amenity-item input[type="checkbox"]{
    width:13px;
    height:13px;
    accent-color:#3563ff;
    cursor:pointer;
}

/* TEXT */

.amenity-item span{
    font-size:13px;
    color:#444;
}

/* UPLOAD BOX */

.upload-box{
    height:170px;
    border:2px dashed #d9dee8;
    border-radius:16px;
    background:#fafbfd;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    text-align:center;
}

/* ICON */

.upload-box i{
    font-size:30px;
    color:#4a70ff;
    margin-bottom:14px;
}

/* TEXT */

.upload-box p{
    color:#4a70ff;
    font-size:14px;
    font-weight:600;
    margin-bottom:5px;
}

.upload-box span{
    font-size:12px;
    color:#999;
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
