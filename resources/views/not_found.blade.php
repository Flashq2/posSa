<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    .center {
            border-radius: 10px;
            background: #e0e0e0;
            box-shadow: 20px 20px 60px #bebebe,
                -20px -20px 60px #ffffff;
            padding: 60px;
            padding: 30px;
            position: absolute;
            margin-top: 60px;
            left: 50%;
            top: 40%;
            width: 300px;
            transform: translate(-50%, -50%);
            text-align: center;

        }
        .btn {
  font-size: larger;
  height: 3em;
  width: 8em;
  position: relative;
  border: none;
  isolation: isolate;
}

.btn > span {
  position: absolute;
  border-radius: 0.5em;
  pointer-events: none;
  inset: 0;
  background-color: hsl(218, 68%, 52%);
  color: white;
  box-shadow: 1px 2px 4px #0007;
  z-index: 10;
  display: flex;
  justify-content: center;
  align-items: center;
}

.ripple-container {
  position: absolute;
  inset: -0.3em;
  display: grid;
  grid-template-columns: repeat(16, 0.5em);
  border-radius: 0.8em;
  padding: 0.3em;
  overflow: hidden;
}

.ripple-container > span {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
}

.ripple-container > span::after {
  content: "";
  pointer-events: none;
  position: absolute;
  background-color: hsl(218, 68%, 65%);
  transition: width 0.5s ease-out, height 0.5s ease-out, opacity 1s;
  width: 18em;
  height: 18em;
  opacity: 0;
  border-radius: 999em;
}

.ripple-container > span:active::after {
  transition: 0s;
  width: 0em;
  height: 0em;
  opacity: 1;
}

.ripple-container::before {
  content: "";
  pointer-events: none;
  position: absolute;
  background-color: hsla(218, 68%, 65%, 0.5);
  width: 13em;
  height: 13em;
  border-radius: 999em;
  transition: transform 0.25s ease-out;
  transform: translate(-25%, -25%) scale(0);
}

.ripple-container:hover::before {
  transform: translate(-25%, -25%) scale(1);
}

</style>
<body>
    <div class="center">
        <h1>Page Not Found</h1>
  
    </div>
</body>
</html>