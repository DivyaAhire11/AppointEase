<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <!-- <link rel="stylesheet" href="../Style/bookAppoint.css"> -->
    <style>
        .book-appointment {
            max-width: 60vw;
            margin: 30px auto;
            padding: 25px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .book-content {
            /* width: 0vw; */
            display: flex;
            gap: 30px;
           
            /* align-items: center;  */
           
        }

        /* LEFT SIDE (FORM)  */
        .book-content form {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* RIGHT SIDE (IMAGE)  */
        /* .book-img {
    flex: 1; */
        /* text-align: center;  */
        /* } */

        .book-img img {
            /* width: 100%; */
            width: 300px;
            height: 70vh;
            border-radius: 10px;
            object-fit: cover;
        }


        .book-appointment h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        /* Form  */
        .book-appointment form {
            display: flex;
            flex-direction: column;
        }

        /* Labels  */
        .book-appointment label {
            margin: 10px 0 5px;
            /* font-weight: 600;  */
            font-weight: bold;
            color: #555;
        }

        /* Inputs & Select  */
        .book-appointment input,
        .book-appointment select {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .book-appointment input:focus,
        .book-appointment select:focus {
            border-color: #2c7be5;
            outline: none;
        }

        /* Button  */
        .book-appointment button {
            margin-top: 20px;
            padding: 12px;
            background: #2c7be5;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            /* transition: background 0.3s; */
        }

        .book-appointment button:hover {
            background: #1a5dc9;
        }

        /* Responsive  */
        @media (max-width: 600px) {
            .book-appointment {
                margin: 30px 15px;
                padding: 20px;
            }
        }

        @media screen and (max-width:768px) {
            .book-content {
                flex-direction: column;
            }

            .book-img img {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="book-appointment">
        <h2>Book Appointment</h2>

        <div class="book-content">
            <div class="book-img">
                <img src="../images/MedicineTechnology.jpg" alt="Medical Technology">
            </div>


            <form action="AppointBook.php" method="post">
                <label>Patient Name </label>
                <input type="text" name="patient_name" required>

                <label>Email </label>
                <input type="email" name="email" required>

                <label>Doctor </label>
                <select name="doctor" required>
                    <option value="">Select Doctor</option>
                    <option value="John">Dr. John</option>
                    <option value="Smith">Dr. Smith</option>
                </select>

                <label>Date</label>
                <input type="date" name="date" required>

                <label>Time</label>
                <input type="time" name="time" required>

                <button type="submit" name="submit">Book Appointment</button>

            </form>
        </div>


    </div>
</body>

</html>