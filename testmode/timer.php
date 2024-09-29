<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Korean Time Countdown</title>
</head>
<body>
  <h1 id="countdown"></h1>

  <script type="text/javascript">
    function getTime() {
      // Get current time in Korea
      const now = new Date(new Date().toLocaleString("en-US", {timeZone: "Asia/Seoul"}));
      
      const k_year = now.getFullYear();
      const k_month = now.getMonth();
      const k_day = now.getDate();
      const k_hour = 24; // Set to a future time in 24-hour format
      const k_min = 0; // Set to a future time

      let dday = new Date(k_year, k_month, k_day, k_hour, k_min, 0);
      
      // If the current time is later than the set time, reset to the same time on the next day
      if (now > dday) {
        dday.setDate(dday.getDate() + 1);
      }

      const remainingTime = dday - now;

      const days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
      const hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

      document.getElementById("countdown").innerHTML = days + "일 " + hours + "시간 " + minutes + "분 " + seconds + "초";

      // Set a timeout for the next second
      setTimeout(getTime, 1000);
    }

    // Call the function to start the countdown
    getTime();
  </script>
</body>
</html>
