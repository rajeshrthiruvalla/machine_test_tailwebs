<!doctype html>
<html>
    <head>
      <link rel="stylesheet" href="{{asset('style.css')}}"/>
      <link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css')}}" />
    </head>
    <body>
        <div class="navigation">
           <div class="brand">
              tailwebs.
           </div>
           <div class="nav-links">
             <a class="nav-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="#">Logout</a>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                 @csrf
             </form>
             <a class="nav-item" href="{{url('home')}}">Home</a>
           </div>
        </div>
        <div class="main-container">
          <div>
            <table class="table">
               <thead>
                 <tr>
                    <td class="width-name">Name</td>
                    <td class="width-subject"><span>|</span> Subject</td>
                    <td class="width-mark"><span>|</span> Mark</td>
                    <td class="width-action"><span>|</span> Action</td>
                 </tr>
               </thead>
               <tbody>
                <tr>
                   <td><span class="badge">R</span> Rajesh</td>
                   <td>Maths</td>
                   <td>77</td>
                   <td>
                        <div class="dropdown">
                            <button class="dropbtn">
                                <i class="fa-solid fa-caret-down"></i>
                            </button>
                            <div class="dropdown-content">
                              <a href="#">Edit</a>
                              <a href="#">Delete</a>
                            </div>
                          </div>
                    </td>
                </tr>
               </tbody>
            </table>
          </div>
          <div>
            <button class="black-white-button margin-top-large" style="width: 200px" id="myBtn">Add</button>
          </div>
        </div>

        <!-- The Modal -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
            <span class="close">&times;</span>
            <div class="card">
                <form method="POST" onsubmit="event.preventDefault();submitData()">
                    @csrf
                    <div>
                        <label class="input-label">Name</label>
                        <div class="input-group">
                            <span class="icon-container"><i class="fa-regular fa-user"></i></span>
                            <input id="name" type="text" class="input-item width-large"/>
                        </div>
                    </div>
                    <div>
                        <label class="input-label">Subject</label>
                        <div class="input-group">
                            <span class="icon-container"><i class="fa-regular fa-message"></i></span>
                            <input id="subject" type="text" class="input-item width-large"/>
                        </div>
                    </div>
                    <div>
                        <label class="input-label">Mark</label>
                        <div class="input-group">
                            <span class="icon-container"><i class="fa-regular fa-bookmark"></i></span>
                            <input id="mark" type="number" class="input-item width-large"/>
                        </div>
                    </div>
                    <div class="center margin-top-large">
                        <button type="submit" class="black-white-button">
                            Add
                        </button>
                    </div>
                </form>
            </div>
            </div>

        </div>
        <script>
            // Get the modal
            var modal = document.getElementById("myModal");

            // Get the button that opens the modal
            var btn = document.getElementById("myBtn");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks the button, open the modal
            btn.onclick = function() {
              modal.style.display = "block";
            }

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
              modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
              if (event.target == modal) {
                modal.style.display = "none";
              }
            }
            </script>
            <script>
                function submitData()
                {
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "https://example.com/api", true);
                    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            // Request finished and response is ready
                            console.log(xhr.responseText);
                        }
                    };

                    var data = JSON.stringify({
                        key1: "value1",
                        key2: "value2"
                    });

                    xhr.send(data);

                }
            </script>
    </body>
</html>
