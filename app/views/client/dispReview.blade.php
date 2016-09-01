@extends('layouts.usermain')

@section('title')
    {{$job->title}}
@stop

@section('head-content')
    <style type="text/css">
        .badge {
            background-color: #1ABC9C;
            width: auto;
            max-width: 8em;
            overflow:hidden;
            white-space:nowrap;
            text-overflow:ellipsis;
        }
        body{background-color:#E9EAED;}
        .accordion-toggle
        {
            text-decoration: none !important;
        }

        /*.hrLine*/
        /*{*/
            /*background:none;*/
            /*border:0;*/
            /*border-bottom:1px solid #2980b9;*/
            /*min-width: 100%;*/
            /*height:1px;*/
        /*}*/

        .applicant-container {
            min-height: 1em;
            border-bottom:
            #ECF0F1 1px solid;
            /*transition: 0.3s;*/
        }

        .applicant-container:hover {
            background-color: #F0FFFF;
        }

        .block-update-card {
                padding: 0.8em;
              height: 100%;
              border: 1px #FFFFFF solid;
              /*width: 380px;*/
              float: left;
              /*margin-left: 10px;*/
              /*margin-top: 0;*/
              /*padding: 0;*/
              box-shadow: 1px 1px 8px #d8d8d8;
              background-color: #FFFFFF;
            }
            .block-update-card .h-status {
              width: 100%;
              height: 7px;
              background: repeating-linear-gradient(45deg, #606dbc, #606dbc 10px, #465298 10px, #465298 20px);
            }
            .block-update-card .v-status {
              width: 5px;
              height: 80px;
              float: left;
              margin-right: 5px;
              background: repeating-linear-gradient(45deg, #606dbc, #606dbc 10px, #465298 10px, #465298 20px);
            }
            .block-update-card .update-card-MDimentions {
              width: 80px;
              height: 80px;
            }
            .block-update-card .update-card-body {
              margin-top: 10px;
              margin-left: 5px;
            }
            .block-update-card .update-card-body h4 {
              color: #737373;
              font-weight: bold;
              /*font-size: 13px;*/
            }
            .block-update-card .update-card-body p {
              color: #737373;
              font-size: 12px;
            }
            .block-update-card .card-action-pellet {
              padding: 5px;
            }
            .block-update-card .card-action-pellet div {
              margin-right: 10px;
              font-size: 15px;
              cursor: pointer;
              color: #dddddd;
            }
            .block-update-card .card-action-pellet div:hover {
              color: #999999;
            }
            .block-update-card .card-bottom-status {
              color: #a9a9aa;
              font-weight: bold;
              font-size: 14px;
              border-top: #e0e0e0 1px solid;
              padding-top: 5px;
              margin: 0px;
            }
            .block-update-card .card-bottom-status:hover {
              background-color: #dd4b39;
              color: #FFFFFF;
              cursor: pointer;
            }

            /*
            Creating a block for social media buttons
            */
            .card-body-social {
              font-size: 30px;
              margin-top: 10px;
            }
            .card-body-social .git {
              color: black;
              cursor: pointer;
              margin-left: 10px;
            }
            .card-body-social .twitter {
              color: #19C4FF;
              cursor: pointer;
              margin-left: 10px;
            }
            .card-body-social .google-plus {
              color: #DD4B39;
              cursor: pointer;
              margin-left: 10px;
            }
            .card-body-social .facebook {
              color: #49649F;
              cursor: pointer;
              margin-left: 10px;
            }
            .card-body-social .linkedin {
              color: #007BB6;
              cursor: pointer;
              margin-left: 10px;
            }

            .starrr {
                font-size: 2em;
                color: #F1C40F;
            }
    </style>

    <script>
    // Starrr plugin (https://github.com/dobtco/starrr)
    var __slice = [].slice;

    (function($, window) {
      var Starrr;

      Starrr = (function() {
        Starrr.prototype.defaults = {
          rating: void 0,
          numStars: 5,
          change: function(e, value) {}
        };

        function Starrr($el, options) {
          var i, _, _ref,
            _this = this;

          this.options = $.extend({}, this.defaults, options);
          this.$el = $el;
          _ref = this.defaults;
          for (i in _ref) {
            _ = _ref[i];
            if (this.$el.data(i) != null) {
              this.options[i] = this.$el.data(i);
            }
          }
          this.createStars();
          this.syncRating();
          this.$el.on('mouseover.starrr', 'span', function(e) {
            return _this.syncRating(_this.$el.find('span').index(e.currentTarget) + 1);
          });
          this.$el.on('mouseout.starrr', function() {
            return _this.syncRating();
          });
          this.$el.on('click.starrr', 'span', function(e) {
            return _this.setRating(_this.$el.find('span').index(e.currentTarget) + 1);
          });
          this.$el.on('starrr:change', this.options.change);
        }

        Starrr.prototype.createStars = function() {
          var _i, _ref, _results;

          _results = [];
          for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
            _results.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"));
          }
          return _results;
        };

        Starrr.prototype.setRating = function(rating) {
          if (this.options.rating === rating) {
            rating = void 0;
          }
          this.options.rating = rating;
          this.syncRating();
          return this.$el.trigger('starrr:change', rating);
        };

        Starrr.prototype.syncRating = function(rating) {
          var i, _i, _j, _ref;

          rating || (rating = this.options.rating);
          if (rating) {
            for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
              this.$el.find('span').eq(i).removeClass('glyphicon-star-empty').addClass('glyphicon-star');
            }
          }
          if (rating && rating < 5) {
            for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
              this.$el.find('span').eq(i).removeClass('glyphicon-star').addClass('glyphicon-star-empty');
            }
          }
          if (!rating) {
            return this.$el.find('span').removeClass('glyphicon-star').addClass('glyphicon-star-empty');
          }
        };

        return Starrr;

      })();
      return $.fn.extend({
        starrr: function() {
          var args, option;

          option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
          return this.each(function() {
            var data;

            data = $(this).data('star-rating');
            if (!data) {
              $(this).data('star-rating', (data = new Starrr($(this), option)));
            }
            if (typeof option === 'string') {
              return data[option].apply(data, args);
            }
          });
        }
      });
    })(window.jQuery, window);

    $(function() {
      return $(".starrr").starrr();
    });

    $( document ).ready(function() {

      $('#stars').on('starrr:change', function(e, value){
        $('#count').html(value);
        $('#input_count').val(value);
      });

      $('#stars-existing').on('starrr:change', function(e, value){
        $('#count-existing').html(value);
      });
    });
    </script>
@stop


@section('content')
<section>
    <div class="container lato-text">
        <div class="col-md-6">
            <div class="widget-container padded" style="display: flex; min-height:125px; display:block !important;">
              <h3 style="margin: 0;"><a target="_tab" href="/jobDetails={{$job->id}}">{{$job->title}}</a></h3>
              <span style="color: #7F8C8D; font-size: 0.8em;">{{$job->created_at}}</span>
              <br/>
              <br/>
              <div class="row" style="text-align: left">
                  <div class="col-md-6">
                      <div class="col-md-12">
                          <label>Work Duration : </label>
                          @if($job->hiring_type == 'LT6MOS')
                              Less than 6 months
                          @else
                              Greater than 6 months
                          @endif
                      </div>
                      <div class="col-md-12">
                          <label>Work Location : </label>{{ $job->cityname }}, {{ $job->regname }}
                      </div>
                      @if($job->salary != 0)
                          <div class="col-md-12">
                              <label>Salary : </label>
                              P{{ $job->salary }}
                          </div>
                      @endif
                      <br/>
                      <br/>
                      <br/>
                      <br/>
                      <div class="col-md-12">
                          <label>Skill Category : </label>{{ $job->categoryname }}<br/>
                          <label>Skills Needed : </label>{{$job->itemname}}
                          @foreach($custom_skills as $cs)
                              {{$cs->skill}} <br/>
                          @endforeach
                      </div>
                      <br/><br/><br/>
                  </div>
                  <div class="col-md-6" style="word-wrap: break-word; text-align: justify;">
                      <label>Description</label><br/>
                      {{ $job->description }}
                  </div>
              </div>
              <br/>
              <div class="row">
                  <div class="col-md-6">
                      <div class="col-md-12 well" style="text-align: justify;">
                          <label>Requirements</label><br/>
                          {{$job->requirements}}
                      </div>
                  </div>
                  @if($job->AverageProcessingTime || $job->Industry || $job->CompanySize || $job->WorkingHours || $job->DressCode)
                      <div class="col-md-6" style="text-align: justify;">
                          <h4>Company Snaphots</h4>
                          @if($job->AverageProcessingTime)
                              <label>Average Processing Time</label><br/>
                              {{$job->AverageProcessingTime}}<br/>
                          @endif

                          @if($job->Industry)
                              <label>Industry</label><br/>
                              {{$job->Industry}}<br/>
                          @endif

                          @if($job->CompanySize)
                              <label>Company Size</label><br/>
                              {{$job->CompanySize}}<br/>
                          @endif

                          @if($job->WorkingHours)
                              <label>Working Hours</label><br/>
                              {{$job->WorkingHours}}<br/>
                          @endif

                          @if($job->DressCode)
                              <label>Dress Code</label><br/>
                              {{$job->DressCode}}
                          @endif
                      </div>
                  @endif
              </div>
          </div>
        </div>
        <div class="col-md-6">
            <div class="widget-container fluid-height">
                <div class="widget-content padded">
                    <h3 style="margin: 0;">
                        <a target="_tab" href="/{{$worker->username}}">
                        @if($isCheckedOut)
                            {{$worker->fullName}}
                        @else
                            {{substr_replace($worker->firstName, str_repeat('*', strlen($worker->firstName)-1), 1)}}
                            &nbsp;
                            {{substr_replace($worker->lastName, str_repeat('*', strlen($worker->lastName)-1), 1)}}
                        @endif
                        </a>
                    </h3>
                    Reviewed at {{$fb->created_at}}
                    <p>
                        {{str_repeat('<i class="fa fa-star" style="color: #F1C40F;"></i>', $fb->stars)}}
                        {{str_repeat('<i class="fa fa-star-o" style="color: #F1C40F;"></i>', (5-$fb->stars))}}
                    </p>
                    <p style="text-align: justify;">{{$fb->review}}</p>
                    <p style="text-align: justify;">{{$fb->suggestion}}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@stop