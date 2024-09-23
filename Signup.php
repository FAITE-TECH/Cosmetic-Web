<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="reg.js" type="text/javascript"></script>
  <title>Sign Up</title>

  <style>
    body, html {
      height: 100%;
      margin: 0;
      padding: 0;
      background-color: black;
      font-family: Arial, Helvetica, sans-serif;
    }

    #back {
      background-image: url("https://m.media-amazon.com/images/I/71rRSZuBkcL.jpg");
      min-height: 750px;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .reg {
      background: rgba(0, 0, 0, 0.6);
      color: #f1f1f1;
      padding: 30px;
      border-radius: 15px;
      width: 100%;
      max-width: 500px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
    }

    .btn-custom {
      background-color: #84c32f;
      color: white;
      width: 100%;
      border-radius: 15px;
    }

    .btn-custom:hover {
      background-color: #6ba027;
    }

    h3 {
      color: #84c32f;
      text-align: center;
      font-family: "Times New Roman", Times, serif;
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <div id="back">
    <form id="frm" action="configreg.php" method="post" class="reg needs-validation" novalidate>
      <h3>Owshadham Registration</h3>

      <div class="mb-3">
        <label for="Uname" class="form-label"><b>User Name</b></label>
        <input type="text" class="form-control" id="Uname" name="Uname" placeholder="Enter Your User Name" required>
      </div>

      <div class="mb-3">
        <label for="Mnumber" class="form-label"><b>Mobile Number</b></label>
        <input type="number" class="form-control" id="Mnumber" name="Mnumber" placeholder="Enter Valid Mobile Number" required>
      </div>

      <div class="mb-3">
        <label for="myEmail" class="form-label"><b>Email</b></label>
        <input type="email" class="form-control" id="myEmail" name="myEmail" placeholder="Enter Email" required>
      </div>

      <div class="mb-3">
        <label for="pwrd" class="form-label"><b>Password</b></label>
        <input type="password" class="form-control" id="pwrd" name="pwrd" placeholder="Enter Password" required>
      </div>

      <div class="form-check mb-3">
        <input type="checkbox" class="form-check-input" id="cb" onclick="enableButton()">
        <label class="form-check-label" for="cb">Accept privacy policy and terms</label>
      </div>

      <button type="submit" class="btn btn-custom" id="btn" name="sign" disabled>Sign Up</button>
    </form>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    function enableButton() {
      var checkBox = document.getElementById("cb");
      var btn = document.getElementById("btn");
      btn.disabled = !checkBox.checked;
    }
  </script>
</body>
</html>
