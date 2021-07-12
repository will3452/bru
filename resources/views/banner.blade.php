<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
      ul {
        display: flex;
        margin: 0;
        padding: 0;
        overflow: hidden;
      }
      li {
        display: block;
        list-style: none;
      }
      button.prev,
      button.next {
        display: flex;
        font-size: 32px;
        align-items: center;
        justify-content: center;
        color: #fff;
        background-color: #333;
        border-radius: 50%;
        width: 44px;
        height: 44px;
      }
      button.prev {
        position: absolute;
        left: 0;
        top: 80px;
      }
      button.next {
        position: absolute;
        right: 0;
        top: 80px;
      }
      li img {
        width: 100vw;
        /* height: 100vh; */
        object-fit: cover;
      }
    </style>
  </head>
  <body>
    <ul>
      @foreach (\App\Banner::get() as $item)
          <li>
            <img src="{{ $item->image }}" alt="">
          </li>
      @endforeach
    </ul>
    <!-- <button onclick="show(-1)" class="prev">&lt;</button> -->
    <!-- <button onclick="show(+1)" class="next">&gt;</button> -->

    <script>
      let liEls = document.querySelectorAll("ul li");
      let index = 0;
      window.show = function (increase) {
        index = index + increase;
        index = Math.min(Math.max(index, 0), liEls.length - 1);
        liEls[index].scrollIntoView({ behavior: "smooth" });
      };
      let counter = 0;
      setInterval(show, 7000, ++counter); //testing
    </script>
  </body>
</html>
