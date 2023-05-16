@extends('admin.master')
@section('admin')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-CETL8oiIgKF/U9rPmWW0ylQzBm4/WwL4n4eIvM+d2M8QyyiU1X9cSg6U5WwnU8PKnLpV7cTWqNX3uV7f8DxhGQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<head>

    <style>
        p {
            margin-bottom: 15px;
            font-size: 13px;
        }

        .card {
            margin-bottom: 2.5vh;
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
                        <a href="{{ route('users.index') }}" class="btn" style="margin-right:5px"><i class="fa fa-caret-left" title="Back"></i></a>
                        <h4 class="font-size-16" style="margin-left: 10px; margin-top:5px;">{{ $user->first_name }} {{ $user->last_name }}</h4>
                    </div>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-primary waves-effect waves-light" style="padding: 7px 13px; font-size: 14px; margin-right:5px;"><i class="fas fa-pencil-alt" title="Edit"></i> Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger waves-effect waves-light" style="padding: 7px 13px; font-size: 14px;" onclick="return confirm('Are you sure you want to delete this user?')"><i class="fa fa-trash" title="Delete"></i> Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row flex-container" style="display: flex;">
            <div class="col-lg-4 flex-item" style="flex: 1;">

                <div class="card card-body flex-item" style="flex: 1;  margin-bottom: 1vh; height: 67vh; overflow-y: auto;">
                    <img id="showImage" src="{{ (!empty($user->profile_picture) ? url('upload/admin_images/'.$user->profile_picture) : url('upload/default_image.png')) }}" class="img-fluid rounded mx-auto" style="max-width: 100%; height: auto; width: 130px; margin-bottom:7px" alt="Profile Image">

                    <h5 class="card-title" style="margin-top: 10px;">First Name</h5>
                    <p class="card-text">{{ $user->first_name }}</p>

                    <h5 class="card-title">Name of One Parent</h5>
                    <p class="card-text">{{ $user->name_of_one_parent }}</p>

                    <h5 class="card-title">Last Name</h5>
                    <p class="card-text">{{ $user->last_name }}</p>

                    <h5 class="card-title">Birth Date</h5>
                    <p class="card-text">{{ date('d.m.Y.', strtotime($user->birth_date)) }}</p>

                    <div class="row flex-container" style="display: flex; margin-bottom:10px">
                        <div class="col">
                            <h5 class="card-title">Email Address</h5>
                            <p class="card-text" id="email">{{ $user->email }}</p>
                        </div>
                        <div class="col">
                            <button onclick="copyEmail()" class="btn">
                                <i class="far fa-copy"></i>
                            </button>
                        </div>
                    </div>

                    <script>
                        function copyEmail() {
                            var email = document.getElementById("email");
                            var range = document.createRange();
                            range.selectNode(email);
                            window.getSelection().removeAllRanges();
                            window.getSelection().addRange(range);
                            document.execCommand("copy");
                        }
                    </script>

                    <div class="row flex-container" style="display: flex; margin-bottom:10px">
                        <div class="col">
                            <h5 class="card-title">Phone Number</h5>
                            <p class="card-text" id="phone">{{ $user->mobile }}</p>
                        </div>
                        <div class="col">
                            <button onclick="copyPhone()" class="btn">
                                <i class="far fa-copy"></i>
                            </button>
                        </div>
                    </div>

                    <script>
                        function copyPhone() {
                            var phone = document.getElementById("phone");
                            var range = document.createRange();
                            range.selectNode(phone);
                            window.getSelection().removeAllRanges();
                            window.getSelection().addRange(range);
                            document.execCommand("copy");
                        }
                    </script>
                </div>
            </div>
            <div class="col-lg-4 flex-item" style="flex: 1;">
                <div class="card card-body flex-item" style="flex: 1;  margin-bottom: 1vh; height: 67vh; overflow-y: auto;">

                    <h5 class="card-title">Employee Number</h5>
                    <p class="card-text">{{ $user->employee_number }}</p>

                    <h5 class="card-title">JMBG</h5>
                    <p class="card-text">{{ $user->jmbg }}</p>

                    <h5 class="card-title">ID number</h5>
                    <p class="card-text">{{ $user->ID_number }}</p>

                    <h5 class="card-title">Passport number</h5>
                    <p class="card-text">{{ $user->passport_number }}</p>

                    <h5 class="card-title">Bank Account</h5>
                    <p class="card-text">{{ $user->bank_account_number }}</p>

                    <h5 class="card-title">Private Email</h5>
                    <p class="card-text">{{ $user->private_email }}</p>

                    <h5 class="card-title">Address in ID</h5>
                    <p class="card-text">{{ $user->address_in_ID }}</p>

                    <h5 class="card-title">Current Address</h5>

                    <p class="card-text">
                        @php
                        foreach($user->contract()->where('status', 'active')->get() as $contr){
                        $annexLocation = $contr->annexes()->where('reason', 'Promene adrese obavljanja posla')->where('deleted', false)->orderByDesc('created_at')->first();
                        $annexAddress = $annexLocation ? $annexLocation->new_value : '';
                        $address = '';
                        if ($annexLocation) {
                        $address = $annexAddress;
                        echo '<span class="changed" title="Address Changed with Annex">'.$address.'</span>';
                        } else {
                        echo $user->current_address;
                        }
                        }
                        @endphp
                    </p>

                    <h5 class="card-title">Slava</h5>
                    <p class="card-text">{{ $user->slava }}</p>



                </div>

            </div>
            <div class="col-lg-4 flex-item" style="flex: 1;">

                <div class="card card-body flex-item" style="flex: 1; height: 20vh; overflow-y: auto;">
                    <!-- <h4 class="card-title" style="margin-bottom: 10px; font-size: 15px">SEE CONTRACTS</h4> -->
                    <h5 class="card-title">Position</h5>

                    <p class="card-text" style="font-size: 13px;">
                            @php
                            $activeContracts = $user->contract()->where('status', 'active')->get();
                            if ($activeContracts->count() > 0) {
                            foreach ($activeContracts as $contr) {

                            $reasonToSearch = 'Promena pozicije';

                            $latestAnnexPos = $contr->annexes()
                            ->where('deleted', 0)
                            ->whereRaw("FIND_IN_SET('$reasonToSearch', reason) > 0")
                            ->orderByDesc('annex_date')
                            ->first();

                            $annexPositionName = $latestAnnexPos ? $latestAnnexPos->position : '';
                            $currentOrganization = $contr->organization;
                            $annexOrganization = '';
                            $annexPosition = '';
                            $currentPosition = '';

                            foreach ($contr->organization->position as $pos) {
                            if ($pos->id == $contr->position) {
                            $currentPosition = $pos;
                            $currentPositionName = $currentPosition->name;
                            }
                            }

                            if ($latestAnnexPos) {
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
                            echo "<br>";
                            }
                            } else {
                            echo "No active contract found";
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


                    <a href="{{ route('contracts.profile', $user->id) }}" class="btn btn-outline-primary waves-effect waves-light" style="margin-right:5px"><i class="fas fa-file-contract" title="Contracts"></i> Contracts</a>
                </div>


                <style>
                    #link {
                        color: inherit;
                    }

                    #link:hover {
                        color: #002EFF;
                    }
                </style>

                <div class="card card-body flex-item" style="flex: 1; height: 17vh; overflow-y: auto;">
                    <h5 class="card-title" style="margin-bottom: 3px; font-size: 13px;">Professional Qualifications Level</h5>
                    <p class="card-text" style="margin-bottom: 11px; font-size: 13px;">{{ $user->professional_qualifications_level }}</p>

                    <h5 class="card-title" style="font-size: 13px; margin-bottom: 3px; ">Profession</h5>
                    <p class="card-text" style="font-size: 13px;">{{ $user->profession }}</p>
                </div>


                <!--
                <div class="card card-body flex-item" style="flex: 1;">

                    <h4 class="card-title" style="margin-bottom: 15px;">TEAM</h4>
                    <h5 class="card-title">Lead</h5>
                    <p class="card-text">Ime Prezime</p>

                    <h5 class="card-title">Manager</h5>
                    @if(!($user->manager))
                    <div class="max-w-xl" style="margin-bottom: 10px;"> Manager: No </div>
                    @endif

                    @if($user->manager)
                    <div class="max-w-xl" style="margin-bottom: 10px;"> Manager: Yes</div>
                    @endif

                </div>
                    -->
                <div class="card card-body flex-item" style="flex: 1;  margin-bottom: 1vh; height: 25vh; overflow-y: auto;">
                    <h5 class="card-title">Emergency Contact Name</h5>
                    <p class="card-text" style="font-size: 13px;">{{ $user->emergency_contact_name }}</p>

                    <h5 class="card-title" style="font-size: 13px; margin-bottom: 3px; ">Emergency Contact Number</h5>
                    <p class="card-text" style="font-size: 13px;">{{ $user->emergency_contact_number }}</p>

                    <a href="javascript:void(0)" class="btn btn-outline-primary waves-effect waves-light" style="padding: 7px 13px; font-size: 14px;" onclick="openFamilyMembersPopup()">
                        <i class="fas fa-user-friends"></i></i> See Family Members
                    </a>


                </div>



            </div>

        </div>
        <!-- end row -->


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
                                        <!--
                                        <th>Action</th>
                                        -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1; ?>
                                    @foreach ($user->familyMembers as $member)
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$member->relationship}}</td>
                                        <td>{{$member->name}}</td>
                                        <td>{{ date('d.m.Y.', strtotime($member->birth_date)) }}</td>
                                        <td>{{$member->jmbg}}</td>
                                        <!--
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
                                                    -->
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
<!-- End Page-content -->
@endsection