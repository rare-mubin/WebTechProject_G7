<!DOCTYPE html>
<html lang="en">
<head>

    <title>Rooms Type</title>

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, Helvetica, sans-serif;
}
.main{
    display:flex;
    gap:25px;
    align-items:flex-start;
}

.rooms-card{
    flex:1;
    background:#fff;
    border-radius:20px;
    padding:25px;
    box-shadow:0 2px 12px rgba(0,0,0,0.05);
}


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



    .table-head{
    display:grid;
    grid-template-columns: 2.3fr 2fr 1fr 1fr 1.4fr 0.9fr;
    gap:20px;
    padding-bottom:16px;
    border-bottom:1px solid #ececec;
    color:#666;
    font-size:14px;
    font-weight:600;
}

.room-row{
    display:grid;
    grid-template-columns: 2.3fr 2fr 1fr 1fr 1.4fr 0.9fr;
    gap:20px;
    align-items:center;
    padding:22px 0;
    border-bottom:1px solid #f0f2f5;
}

.room-left{
    display:flex;
    align-items:center;
    gap:15px;
}

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

.description{
    font-size:13px;
    line-height:22px;
    color:#666;
}

.rate{
    font-size:14px;
    font-weight:600;
    color:#222;
}

.capacity{
    font-size:13px;
    line-height:22px;
    color:#555;
}
.amenities{
    font-size:13px;
    line-height:22px;
    color:#555;
    display:flex;
    flex-wrap:wrap;
    gap:7px;
}

.amenity-chip{
    display:inline-flex;
    align-items:center;
    gap:5px;
    border-radius:20px;
    background:#f5f7fb;
    border:1px solid #e2e7f0;
    padding:5px 8px;
}

.amenity-chip i{
    color:#3563ff;
}

.muted,
.empty-state{
    color:#888;
    font-size:13px;
}

.action{
    display:flex;
    align-items:center;
    gap:8px;
}

.edit-btn{
    width:38px;
    height:38px;
    border:none;
    border-radius:12px;
    background:#eef3ff;
    color:#3563ff;
    font-size:15px;
    cursor:pointer;
    transition:0.3s;
}

.edit-btn:hover{
    background:#3563ff;
    color:#fff;
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
.add-room-card{
    width:380px;
    background:#fff;
    border-radius:20px;
    padding:25px;
    box-shadow:0 2px 12px rgba(0,0,0,0.05);
}

.add-room-card h2{
    font-size:26px;
    color:#222;
    margin-bottom:25px;
}

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


textarea{
    height:110px;
    resize:none;
}


.amenities-box{
    display:flex;
    flex-wrap:wrap;
    gap:12px;
}



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

.amenity-item input[type="checkbox"]{
    width:13px;
    height:13px;
    accent-color:#3563ff;
    cursor:pointer;
}



.amenity-item span{
    font-size:13px;
    color:#444;
}

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


.upload-box i{
    font-size:30px;
    color:#4a70ff;
    margin-bottom:14px;
}

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

.cancel-btn{
    width:100%;
    height:44px;
    border:1px solid #dfe3ea;
    border-radius:12px;
    background:#fff;
    color:#555;
    font-size:14px;
    font-weight:600;
    cursor:pointer;
    margin-top:10px;
}

.cancel-btn:hover{
    background:#f5f7fb;
}
.error{
    color:red;
    font-size:13px;
    margin-top:6px;
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

        <div id="roomTypeRows"></div>

    </div>

    <!-- RIGHT SIDE -->
    <form id="roomTypeForm" class="add-room-card" onsubmit="event.preventDefault(); saveRoomType();" enctype="multipart/form-data">

    <h2 id="roomTypeFormTitle">Add Room Type</h2>
    <input type="hidden" id="roomTypeId" name="roomTypeId">

    <div class="input-box">
        <label>Room Type Name</label>
        <input type="text" id="roomtypeName" name="roomtypeName" placeholder="Enter room type name">
        <p id="roomtypeNameError" class="error"></p>
    </div>

    <div class="input-box">
        <label>Per Night Rate</label>
        <input type="text" id="perNightRate" name="perNightRate">
        <p id="perNightRateError" class="error"></p>
    </div>

    <div class="input-box">
        <label>Description</label>
        <textarea id="description" name="description" placeholder="Write room description..."></textarea>
        <p id="descriptionError" class="error"></p>
    </div>

    <div class="input-box">
        <label>Max Capacity</label>
        <input type="text" id="maxCapacity" name="maxCapacity">
        <p id="maxCapacityError" class="error"></p>
    </div>

    <div class="input-box">
        <label>Amenities</label>

        <div class="amenities-box">
            <label class="amenity-item">
                <input type="checkbox" id="wifi" name="amenities[]" value="WiFi">
                <span>WiFi</span>
            </label>

            <label class="amenity-item">
                <input type="checkbox" id="ac" name="amenities[]" value="AC">
                <span>AC</span>
            </label>

            <label class="amenity-item">
                <input type="checkbox" id="tv" name="amenities[]" value="TV">
                <span>TV</span>
            </label>

            <label class="amenity-item">
                <input type="checkbox" id="minibar" name="amenities[]" value="Minibar">
                <span>Minibar</span>
            </label>

            <label class="amenity-item">
                <input type="checkbox" id="safe" name="amenities[]" value="Safe">
                <span>Safe</span>
            </label>

            <label class="amenity-item">
                <input type="checkbox" id="bathtub" name="amenities[]" value="Bathtub">
                <span>Bathtub</span>
            </label>

            <label class="amenity-item">
                <input type="checkbox" id="balcony" name="amenities[]" value="Balcony">
                <span>Balcony</span>
            </label>
        </div>

        <p id="amenitiesError" class="error"></p>
    </div>

    <div class="input-box">
        <label>Room Image</label>

        <label class="upload-box" for="roomImage">
            <i class="fa-regular fa-image"></i>
            <input type="file" id="roomImage" name="roomImage" accept="image/jpeg,image/png" style="display:none;">
            <p>Click to Upload or drag and drop</p>
            <span>JPEG/PNG, max file size 2 MB</span>
        </label>

        <p id="roomImageError" class="error"></p>
    </div>

    <div class="btn-box">
        <input id="roomTypeSubmit" class="add-btn" type="submit" value="Add Room Type">
        <button id="cancelEditBtn" class="cancel-btn" type="button" onclick="resetRoomTypeForm();" style="display:none;">Cancel Edit</button>
    </div>

</form>

</div>


</body>
</html>
