@extends('layouts.app')

@section('content')
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
               <tbody id="tbody">
                @foreach ($students as $student)
                    <tr id="tr-{{$student->id}}">
                        <td><span class="badge">{{substr($student->name, 0, 1)}}</span> {{$student->name}}</td>
                        <td> {{$student->subject}}</td>
                        <td> {{$student->mark}}</td>
                        <td>
                            <div class="dropdown">
                                <button class="dropbtn">
                                    <i class="fa-solid fa-caret-down"></i>
                                </button>
                                <div class="dropdown-content">
                                <a href="#!" onclick="event.preventDefault();editData({{$student->id}})">Edit</a>
                                <a href="#!" onclick="event.preventDefault();deleteData({{$student->id}})">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
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
                            <input id="id" type="hidden"/>
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
                        <button type="submit" class="black-white-button" id="modal-button">
                            Add
                        </button>
                    </div>
                </form>
            </div>
            </div>

        </div>
        <script>
            var nameObj=document.getElementById("name");
            var subjectObj=document.getElementById("subject");
            var markObj=document.getElementById("mark");
            var idObj=document.getElementById("id");
            var buttonObj=document.getElementById("modal-button");
            function clearInput()
            {
                nameObj.value='';
                subjectObj.value='';
                markObj.value='';
                idObj.value='';
                buttonObj.innerHTML='Add';
            }
            // Get the modal
            var modal = document.getElementById("myModal");

            // Get the button that opens the modal
            var btn = document.getElementById("myBtn");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks the button, open the modal
            btn.onclick = function() {
                clearInput();
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
                function getRowString(record)
                {
                  return  `<td><span class="badge">${record.name.charAt(0)}</span> ${record.name}</td>
                            <td>${record.subject}</td>
                            <td>${record.mark}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropbtn">
                                        <i class="fa-solid fa-caret-down"></i>
                                    </button>
                                    <div class="dropdown-content">
                                        <a href="#!" onclick="event.preventDefault();editData(${record.id})">Edit</a>
                                        <a href="#!" onclick="event.preventDefault();deleteData(${record.id})">Delete</a>
                                    </div>
                                </div>
                            </td>`;
                }
                function saveData()
                {
                    var name=nameObj.value;
                    var subject=subjectObj.value;
                    var mark=markObj.value;

                    var data = {
                        name,
                        subject,
                        mark
                    };
                    fetch('{{route('students.store')}}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify(data)
                        })
                        .then(response => response.json())
                        .then(data => {
                            window.alert(data.message);
                            if(data.status)
                            {
                               var record=data.data;

                               var trReferance=document.getElementById(`tr-${record.id}`);
                               if(trReferance)
                               {
                                trReferance.innerHTML=getRowString(record);
                               }else{

                                    var newtr=`<tr id="tr-${record.id}">
                                                    ${getRowString(record)}
                                                    </tr>`;
                                    var html=newtr+document.getElementById("tbody").innerHTML;
                                    document.getElementById("tbody").innerHTML=html;
                               }

                               clearInput();

                               modal.style.display = "none";

                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }
                function updateData()
                {
                    var name=nameObj.value;
                    var subject=subjectObj.value;
                    var mark=markObj.value;
                    var id=idObj.value;

                    var data = {
                        name,
                        subject,
                        mark,
                        id
                    };
                    fetch(`{{ url("students")}}/${id}`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify(data)
                        })
                        .then(response => response.json())
                        .then(data => {
                            window.alert(data.message);
                            if(data.status)
                            {
                               var record=data.data;
                               var updatetr=getRowString(record);
                               document.getElementById(`tr-${id}`).innerHTML=updatetr;

                               clearInput();

                               modal.style.display = "none";

                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }
                function submitData()
                {
                   if(idObj.value>0)
                   {
                      updateData();
                   }else{
                      saveData();
                   }

                }
                function deleteData(id)
                {
                    fetch(`{{url("students")}}/${id}`, {
                            method: 'delete',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({id})
                        })
                        .then(response => response.json())
                        .then(data => {
                            window.alert(data.message);
                            if(data.status)
                            {
                               document.getElementById(`tr-${id}`).remove();
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }
                function editData(id)
                {
                    clearInput();
                    fetch(`{{url("students")}}/${id}/edit`)
                        .then(response => response.json())
                        .then(data => {
                            if(data.status)
                            {
                               var record= data.data;
                               nameObj.value=record.name;
                               subjectObj.value=record.subject;
                               markObj.value=record.mark;
                               idObj.value=record.id;
                               buttonObj.innerHTML='Update';
                               modal.style.display = "block";
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });

                }
            </script>
@endsection
