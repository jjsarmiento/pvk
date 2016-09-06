@extends('layouts.usermain')


@section('head-content')
    <style type="text/css">
        body{background-color:#E9EAED;}
        /* Added by Jups */
        section{
            background: url("../frontend/img/slideshow/10admin.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            height: auto !important;
            max-height: 100% !important;
            overflow: scroll;
        }
        h1.lato-text{
            color: white;
        }
        .widget-container{
            background-color: rgba(245,245,245,0.3);
        }
        .breadcrumb, .panel-heading{
            background-color: rgba(245,245,245,0.7);
        }
        .breadcrumb>li{
            color: white !important;
        }
        a.sidemenu {
            color: white;
        }
        a.sidemenu:hover {
            transition: 0.3s;
            color: #d9d9d9;
            text-decoration: none;
        }
        .col-md-7, .col-md-5{
            color: white;
        }
        @media (max-width: 767px){
            ul.breadcrumb {
                margin: 50px 15px 0px;
            }
        }
        /*-----------------*/
    </style>
@stop

@section('title')
    Manage Task Categories and Skills
@stop

@section('content')
<section>
    <div class="container lato-text">
        <div class="row">
            <div class="col-lg-12 no-padding">
                <ul class="breadcrumb">
                    <li>
                        <a href="/" style="cursor: pointer;"><i class="fa fa-home"></i></a>
                    </li>
                    <li class="active">
                        <a href="/skills">Manage Task Categories and Skills</a>
                    </li>
                    <li>
                        Manage Skills for Skill Category - {{$cat->categoryname}}
                    </li>
                </ul>
            </div>
        </div>
        <div style="clear:both;"></div>
        @if(Session::has('errorm'))
            <span style="color: red">{{ Session::get('errorMsg') }}</span>
        @elseif(Session::has('succmsg'))
            <span style="color: green">{{ Session::get('successMsg') }}</span>
        @endif
        <br/>
        <div class="row">
            <div class="col-md-8">
                <div class="widget-container fluid-height padded" style="background-color: #ffffff;">
                    @if($skills->count() > 0)
                        <table class="table table-striped table-condensed table-hover">
                            <thead>
                                <th>Skill Name</th>
                                <th>Skill Code</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach($skills as $s)
                                    <tr>
                                        <td>
                                            <span id="label_{{$s->id}}">{{$s->itemname}}</span>
                                            <div id="inputfield_{{$s->id}}" style="display: none;">
                                                <form method="POST" action="doEditCategorySkill">
                                                    <input type="text" name="skill_name" class="form-control" value="{{$s->itemname}}" required="required"/>
                                                    <input type="hidden" name="skill_id" value="{{$s->id}}" />
                                                </form>
                                            </div>
                                        </td>
                                        <td>{{$s->itemcode}}</td>
                                        <td>
                                            <div id="DFLT_MODE_{{$s->id}}">
                                                <a href="#"
                                                    class="dflt-btn"
                                                    data-label="#label_{{$s->id}}"
                                                    data-inputfield="#inputfield_{{$s->id}}"
                                                    data-dfltmode="#DFLT_MODE_{{$s->id}}"
                                                    data-editmode="#EDIT_MODE_{{$s->id}}"
                                                    title="Edit skill"
                                                ><i class="fa fa-edit"></i></a>
                                                &nbsp;
                                                <a href="#" class="a-validate" data-href="deleteSkill={{$s->itemcode}}" data-message="Are you sure you want to delete this skill - {{$s->itemname}}"><i class="fa fa-trash"></i></a>
                                            </div>
                                            <div  id="EDIT_MODE_{{$s->id}}" style="display:none;">
                                                <a href="#"
                                                    class="dflt-btn"
                                                    data-label="#label_{{$s->id}}"
                                                    data-inputfield="#inputfield_{{$s->id}}"
                                                    data-editmode="#EDIT_MODE_{{$s->id}}"
                                                    data-dfltmode="#DFLT_MODE_{{$s->id}}"
                                                    title="Delete Skill"
                                                ><i class="fa fa-close"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <center>{{$skills->links()}}</center>
                    @else
                        <center>No data available.</center>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="widget-container fluid-height padded" style="background-color: #ffffff;">
                    <form method="POST" action="doAddSkillToCategory">
                        <input type="hidden" name="category_code" value="{{$cat->categorycode}}" />
                        <div class="form-group">
                            <label>Skill Name</label>
                            <input type="text" name="skill_name" class="form-control" placeholder="Enter skill name" required="required"/>
                        </div>
                        <button class="btn btn-primary" type="submit">Add SKill</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@stop


@section('body-scripts')
<script>
    $(document).ready(function(){
        $('.dflt-btn').click(function(){
            $($(this).data('dfltmode')).toggle();
            $($(this).data('editmode')).toggle();
            $($(this).data('inputfield')).toggle();
            $($(this).data('label')).toggle();
        });
    })
</script>
@stop