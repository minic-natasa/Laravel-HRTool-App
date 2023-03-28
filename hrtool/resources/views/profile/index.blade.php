@extends('admin.master')
@section('admin')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

<head>
    <script src="{{ asset('assets/js/familymembers.js') }}"></script>
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
                
                        <button class="btn" style="background: transparent; border: 2px solid #252b3b; color: #252b3b; padding: 10px 20px; font-size: 16px; cursor: pointer; display: inline-block;" onclick="window.location.href='/edit-profile';">
                            <i class="fa fa-edit"></i> Edit Profile Informations
                        </button>

                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <!-- PROFILE CARD -->

        <div class="row flex-container" style="display: flex;">
            <div class="col-lg-4 flex-item" style="flex: 1;">

                <div class="card card-body flex-item" style="flex: 1;">

                    <h4 class="card-title" style="margin-bottom: 15px;">PROFILE IMAGE</h4>
                    <img src="{{asset('assets\images\users\Portrait_Placeholder.png')}}" class="img-fluid rounded mx-auto" style="max-width: 100%; height: auto; width: 200px;" alt="Profile Image">
                    <!-- <a href="#" class="btn btn-primary waves-effect waves-light">Change Profile Image</a> -->

                    <h5 class="card-title" style="margin-top: 20px;">First Name</h5>
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
                    <p class="card-text" id="phone">{{ Auth::User()->mobile }}</p>

                    <h5 class="card-title">Position</h5>
                    <p class="card-text">Position</p>
                </div>
            </div>

            <div class="col-lg-4 flex-item" style="flex: 1;">


                <div class="card card-body flex-item" style="flex: 1;">
                    <h4 class="card-title" style="margin-bottom: 37px;">EMPLOYEE DETAILS</h4>

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
                    <p class="card-text">{{ Auth::User()->slava }}</p>

                </div>

            </div>
            <div class="col-lg-4 flex-item" style="flex: 1;">



                <div class="card card-body flex-item" style="flex: 1;">
                    <h4 class="card-title" style="margin-bottom: 15px;">CONTRACT</h4>
                    <p class="card-text">Pop-up</p>
                </div>



                <div class="card card-body flex-item" style="flex: 1;">

                    <h4 class="card-title" style="margin-bottom: 15px;">TEAM</h4>
                    <h5 class="card-title">Lead</h5>
                    <p class="card-text">Ime Prezime</p>

                    <h5 class="card-title">Manager</h5>
                    @if(!(Auth::User()->manager))
                    <div class="max-w-xl" style="margin-bottom: 10px;"> Manager: No </div>
                    @endif

                    @if(Auth::User()->manager)
                    <div class="max-w-xl" style="margin-bottom: 10px;"> Manager: Yes</div>
                    @endif

                </div>

                <div class="card card-body flex-item" style="flex: 1;">
                    <h4 class="card-title" style="margin-bottom: 15px;">FAMILY DETAILS</h4>

                  

                    <h5 class="card-title">Emergency Contact Name</h5>
                    <p class="card-text">{{ Auth::User()->emergency_contact_name }}</p>

                    <h5 class="card-title">Emergency Contact Number</h5>
                    <p class="card-text">{{ Auth::User()->emergency_contact_number }}</p>

                    <button class="btn" style="background: transparent; border: 2px solid #252b3b; color: #252b3b; padding: 10px 20px; font-size: 16px; cursor: pointer; display: inline-block; margin-right:10px" onclick="openAddFamilyMembersPopup()">
                        <i class="fa fa-plus"></i> Add Family Members
                    </button>

                </div>
            </div>
        </div>
        <!-- END BODY CARD -->


        <div class="modal fade" id="addFamilyMembersModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Family Members</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
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
                                <!--    
                        <tr>
                                
                                <td><input type="text" name="relationship" placeholder="Enter relationship" value=""></td>
                                <td><input type="text" name="name" placeholder="Enter name" value=""></td>
                                <td><input type="date" name="birthdate" placeholder="Enter birth date" value=""></td>
                                <td><input type="text" name="jmbg" placeholder="Enter JMBG" value=""></td>
                                <td><button onclick="saveRow(this)">Save</button></td>
        
                            </tr>
                            -->

                                <tr>

                                </tr>
                            </tbody>

                        </table>
                        <div class="text-right">
                            <button class="btn" style="background: #0a1832; border: 2px solid #0a1832; color: white; padding: 10px 20px; font-size: 14px; cursor: pointer" onclick="addNewMember()">Add New Member</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button class="btn" style="background: transparent; border: 2px solid blue; color: blue; padding: 10px 20px; font-size: 14px; cursor: pointer" data-dismiss="modal">Close</button> -->

                        <!--FORM-->

                        <button class="btn" style="background: blue; border: 2px solid blue; color: white; padding: 10px 20px; font-size: 14px; cursor: pointer" onclick="showMembers()">Save changes</button>

                    </div>
                </div>
            </div>
        </div>


    </div>

</div>

<!-- End Page-content -->
@endsection