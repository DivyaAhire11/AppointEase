<div class="book-appointment">
<h2>Book Appointment</h2>
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