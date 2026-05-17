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

        /* ERROR MESSAGE */

        .error{
            color:red;
            font-size:13px;
            margin-top:6px;
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

    </style>
</head>

<body>

<div class="main">

    <!-- LEFT SIDE -->
    <div class="rooms-card">

        <!-- TOP BAR -->
        <div class="top-bar">

            <h2>Rooms</h2>

            <!-- FILTER BOX -->
            <div class="filter-box">

                <select id="roomTypeFilter" onchange="renderRooms();">
                    <option value="">All Type</option>
                </select>

                <select id="roomStatusFilter" onchange="renderRooms();">
                    <option value="">All Status</option>
                    <option value="available">Available</option>
                    <option value="maintenance">Maintenance</option>
                </select>

            </div>

        </div>

        <!-- TABLE HEAD -->
        <div class="table-head">

            <div>Image</div>
            <div>Rate</div>
            <div>Capacity</div>
            <div>Amenities</div>
            <div>Status</div>
            <div>Action</div>

        </div>

        <div id="roomRows"></div>

    </div>

    <!-- RIGHT SIDE / ADD ROOM FORM -->
    <form id="roomForm" class="add-room-card" onsubmit="event.preventDefault(); addRoom();">

        <h2 id="roomFormTitle">Add Room</h2>
        <input type="hidden" id="roomId" name="roomId">

        <!-- ROOM TYPE -->
        <div class="input-box">

            <label>Room Type</label>

            <select id="roomType" name="roomType">
                <option value="">Select Room Type</option>
            </select>

            <!-- ROOM TYPE ERROR -->
            <p id="roomTypeError" class="error"></p>

        </div>

        <!-- ROOM NUMBER -->
        <div class="input-box">

            <label>Room Number</label>

            <input type="text" id="roomNumber" name="roomNumber" placeholder="Room number">

            <!-- ROOM NUMBER ERROR -->
            <p id="roomNumberError" class="error"></p>

        </div>

        <!-- FLOOR -->
        <div class="input-box">

            <label>Floor</label>

            <input type="text" id="floor" name="floor" placeholder=" Floor number">

            <!-- FLOOR ERROR -->
            <p id="floorError" class="error"></p>

        </div>

        <!-- STATUS -->
        <div class="input-box">

            <label>Status</label>

            <select id="status" name="status">
                <option value="available">Available</option>
                <option value="maintenance">Maintenance</option>
            </select>

            <p id="statusError" class="error"></p>

        </div>

        <!-- BUTTON -->
        <div class="btn-box">

            <input id="roomSubmit" class="add-btn" type="submit" value="Add Room">
            <button id="cancelRoomEditBtn" class="cancel-btn" type="button" onclick="resetRoomForm();" style="display:none;">Cancel Edit</button>

        </div>

    </form>

</div>


</body>
</html>
