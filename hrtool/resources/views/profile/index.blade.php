@extends('admin.master')
@section('admin')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<head>
    <script src="{{ asset('assets/js/familymembers.js') }}"></script>

    <style>
        .page-content {
            background-color: #eff3f6;
        }

        p {
            margin-bottom: 15px;
            font-size: 13px;
        }

        .card {
            margin-bottom: 3.9vh;
        }

        h5 {
            margin-bottom: 3px !important;
            font-size: 13px !important;
        }
    </style>

</head>

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <h4 class="font-size-16" style="margin-left: 10px; margin-top:5px;">MY PROFILE</h4>
                    </div>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary waves-effect waves-light" style="padding: 7px 13px; font-size: 14px;"><i class="fas fa-pencil-alt" title="Edit"></i> Edit Profile Informations</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- PROFILE CARD -->

        <div class="row flex-container" style="display: flex;">
            <div class="col-lg-4 flex-item" style="flex: 1;">

                <div class="card card-body flex-item" style="flex: 1;  margin-bottom: 1vh; height: 67vh; overflow-y: auto;">
                    <img id="showImage" src="{{ (!empty(Auth::User()->profile_picture) ? url('upload/admin_images/'.Auth::User()->profile_picture) : url('upload/default_image.png')) }}" class="img-fluid rounded mx-auto" style="max-width: 100%; height: auto; width: 130px; margin-bottom:10px" alt="Profile Image">

                    <h5 class="card-title" style="margin-top: 10px;">First Name</h5>
                    <p class="card-text">{{ Auth::User()->first_name }}</p>

                    <h5 class="card-title">Name of One Parent</h5>
                    <p class="card-text">{{ Auth::User()->name_of_one_parent }}</p>

                    <h5 class="card-title">Last Name</h5>
                    <p class="card-text">{{ Auth::User()->last_name }}</p>

                    <h5 class="card-title">Birth Date</h5>
                    <p class="card-text">{{ Auth::User()->birth_date }}</p>

                    <h5 class="card-title">Email Address</h5>
                    <p class="card-text" id="email">{{ Auth::User()->email }}</p>

                    <h5 class="card-title">Phone Number</h5>
                    <p class="card-text" style="margin-bottom:0px;" id="phone">{{ Auth::User()->mobile }}</p>
                </div>
            </div>

            <div class="col-lg-4 flex-item" style="flex: 1;">


                <div class="card card-body flex-item" style="flex: 1;  margin-bottom: 1vh; height: 67vh; overflow-y: auto;">

                    <h5 class="card-title">Employee Number</h5>
                    <p class="card-text">{{ Auth::User()->employee_number }}</p>

                    <h5 class="card-title">JMBG</h5>
                    <p class="card-text">{{ Auth::User()->jmbg }}</p>

                    <h5 class="card-title">ID number</h5>
                    <p class="card-text">{{ Auth::User()->ID_number }}</p>

                    <h5 class="card-title">Passport number</h5>
                    <p class="card-text">{{ Auth::User()->passport_number }}</p>

                    <h5 class="card-title">Bank Account</h5>
                    <p class="card-text">{{ Auth::User()->bank_account_number }}</p>

                    <h5 class="card-title">Private Email</h5>
                    <p class="card-text">{{ Auth::User()->private_email }}</p>

                    <h5 class="card-title">Address in ID</h5>
                    <p class="card-text">{{ Auth::User()->address_in_ID }}</p>

                    <h5 class="card-title">Current Address</h5>
                    <p class="card-text">{{ Auth::User()->current_address }}</p>

                    <h5 class="card-title">Slava</h5>
                    <p class="card-text" style="margin-bottom:0px;">{{ Auth::User()->slava }}</p>

                </div>

            </div>
            <div class="col-lg-4 flex-item" style="flex: 1;">

                <div class="card card-body flex-item" style="flex: 1; height: 17vh; overflow-y: auto;">
                    <!-- <h4 class="card-title" style="margin-bottom: 10px; font-size: 15px">SEE CONTRACTS</h4> -->
                    <h5 class="card-title">Position</h5>
                    <p class="card-text" style="font-size: 13px;">
                        @php

                        foreach(Auth::User()->contract as $contr){

                        $annex = $contr->annexes()->where('reason', 'Promene pozicije')->latest('created_at')->first();
                        $annexPositionName = $annex ? $annex->new_value : '';
                        $annexPosition = '';
                        $currentPosition = '';
                        $currentOrganization = $contr->organization;
                        $annexOrganization = '';

                        foreach ($contr->organization->position as $pos) {
                        if ($pos->id == $contr->position){
                        $currentPosition = $pos;
                        $currentPositionName = $currentPosition->name;
                        }
                        }

                        if ($annex) {
                        foreach ($organizations as $org) {
                        foreach ($org->position as $pos) {
                        if ($pos->name == $annexPositionName) {
                        $annexOrganization = $pos->organization;
                        $annexPosition = $pos;
                        break;
                        }
                        }
                        }
                        echo '<span class="changed" title="Position Changed with Annex"><a id="link" href="' . route('positions.position-card', $annexPosition->id) . '">' . $annexPosition->name . '</a></span>';
                        } else {
                        echo '<a id="link" href="' . route('positions.position-card', $currentPosition->id) . '">' . $currentPositionName . '</a>';
                        }
                        }
                        @endphp
                    </p>

                    <style>
                        /* Set link color to the same color as normal text */
                        #link {
                            color: inherit;
                            text-decoration: none;
                        }

                        /* Set link color to a different color on hover */
                        #link:hover {
                            color: #002EFF;
                        }
                    </style>


                    <a href="{{ route('contracts.profile', Auth::User()->id) }}" class="btn btn-outline-primary waves-effect waves-light" style="padding: 7px 13px; font-size: 14px;"><i class="fas fa-file-contract" title="Contract"></i> Contracts</a>
                </div>

                <div class="card card-body flex-item" style="flex: 1; height: 17vh; overflow-y: auto;">
                    <h5 class="card-title" style="margin-bottom: 3px; font-size: 13px;">Professional Qualifications Level</h5>
                    <p class="card-text" style="margin-bottom: 11px; font-size: 13px;">{{ Auth::User()->professional_qualifications_level }}</p>

                    <h5 class="card-title" style="font-size: 13px; margin-bottom: 3px; ">Profession</h5>
                    <p class="card-text" style="font-size: 13px;">{{ Auth::User()->profession }}</p>
                </div>


                <div class="card card-body flex-item" style="flex: 1;  margin-bottom: 1vh; height: 25vh; overflow-y: auto;">
                    <h5 class="card-title">Emergency Contact Name</h5>
                    <p class="card-text" style="font-size: 13px;">{{ Auth::User()->emergency_contact_name }}</p>

                    <h5 class="card-title" style="font-size: 13px; margin-bottom: 3px; ">Emergency Contact Number</h5>
                    <p class="card-text" style="font-size: 13px;">{{ Auth::User()->emergency_contact_number }}</p>


                    <div class="btn-group" role="group">
                        <button id="btnGroupVerticalDrop1" type="button" class="btn btn-outline-primary waves-effect waves-light" style="padding: 7px 13px; font-size: 14px;" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-friends"></i> Family Members
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" style="font-size: 12px;">
                            <li><a class="dropdown-item" onclick="openAddFamilyMembersPopup()" href="javascript:void(0)"><i class="fas fa-user-plus"></i> Add Family Members</a></li>
                            <li><a class="dropdown-item" onclick="openFamilyMembersPopup()" href="javascript:void(0)"><i class="fas fa-user-friends"></i> See Family Members</a></li>
                        </div>
                    </div>

                    </a>
                </div>
            </div>
        </div>
        <!-- END BODY CARD -->


        <div class="modal fade" id="addFamilyMembersModal" tabindex="-1" role="dialog" data-id="{{ Auth::user()->id }}">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Family Members</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <input type="hidden" name="family_member_id" id="family_member_id" value=""> <!-- Add the hidden input field here -->
                        <table id="familyMembersTable" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Relationship</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Birth Date</th>
                                    <th scope="col">JMBG</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>

                            <tbody id="familyMembersTableBody">
                            @csrf
                            </tbody>

                        </table>
                        <div class="text-right">
                            <button class="btn" style="background: #0a1832; border: 2px solid #0a1832; color: white; padding: 10px 20px; font-size: 14px; cursor: pointer" onclick="addNewMember()">Add New Member</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button class="btn" style="background: transparent; border: 2px solid blue; color: blue; padding: 10px 20px; font-size: 14px; cursor: pointer" data-dismiss="modal">Close</button> -->

                        <button id="saveChangesBtn" class="btn" style="background: blue; border: 2px solid blue; color: white; padding: 10px 20px; font-size: 14px; cursor: pointer" onclick="showMembers()">Save changes</button>

                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="familyMembersModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Family Members</h5>
                        <button type="btn" class="close" style="color:black; border: none; background: transparent; cursor: pointer" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body" style="height: 55vh;">

                        <div class="table-responsive" style="max-height: 50vh; overflow: scroll;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Relationship</th>
                                        <th>Name</th>
                                        <th>Birth Date</th>
                                        <th>JMBG</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1; ?>
                                    @foreach (Auth::User()->familyMembers as $member)
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$member->relationship}}</td>
                                        <td>{{$member->name}}</td>
                                        <td>{{ date('d.m.Y.', strtotime($member->birth_date)) }}</td>
                                        <td>{{$member->jmbg}}</td>
                                        <td>
                                            <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                                <div class="btn-group" role="group">
                                                    <button id="btnGroupVerticalDrop1" type="button" class="btn waves-effect" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="ri-more-line"></i>
                                                    </button>

                                                    <div class="dropdown-menu" id="actionMenu" aria-labelledby="btnGroupVerticalDrop1">
                                                        <a href="" class="btn btn-primary" style="margin-right:5px; margin-left:5px"><i class="fas fa-pencil-alt" title="Edit"></i></a>
                                                        <form action="" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this member?')"><i class="fa fa-trash" title="Delete"></i></button>
                                                        </form>
                                                    </div>

                                                    <style>
                                                        #actionMenu {
                                                            min-width: 7vw !important;
                                                        }
                                                    </style>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $count++; ?>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function openFamilyMembersPopup() {
                $('#familyMembersModal').modal('show');
            }
        </script>
    </div>

</div>

<script>
    document.getElementById('saveChangesBtn').addEventListener('click', function() {

        // Collect data from the form
        const familyMembersTable = document.getElementById('familyMembersTableBody');
        const rows = familyMembersTable.querySelectorAll('tr');
        const familyMembers = [];

        rows.forEach(row => {
            const relationship = row.querySelector('.relationship').value;
            const name = row.querySelector('.name').value;
            const birth_date = row.querySelector('.birth_date').value;
            const jmbg = row.querySelector('.jmbg').value;

            familyMembers.push({
                relationship: relationship,
                name: name,
                birth_date: birth_date,
                jmbg: jmbg
            });

        });
        console.log(familyMembers);
        // Send an HTTP POST request to the controller method
        axios.post('/profile', {
                familyMembers: familyMembers
            }, {
                headers: {
                    // Include the CSRF token in the headers
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => {
                console.log(response.data);
                // Do something with the response, like display a success message
            })
            .catch(error => {
                console.log(error.response.data);
                // Do something with the error, like display an error message
            });
    });
</script>


<!-- End Page-content -->

@endsection