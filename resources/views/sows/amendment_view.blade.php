  <div class="app-page-title">
      <div class="page-title-wrapper">
          <div class="page-title-heading">
              <div class="page-title-icon title-clipboard-icon">
                  <img src="{{asset('assets/images/clipboard.png')}}" class="clipboard-icon">
              </div>
              <div>AMENDMENT TO ORIGINAL STATEMENT OF WORK
                  <div class="page-title-subheading">
                  {{ Breadcrumbs::render('sows_action', $filter, $sow ) }}

                  </div>
              </div>
          </div>
          <!-- <div class="page-title-actions">
              <div class="d-inline-block dropdown">
                  <a class="btn btn-primary" href="{{ route('sows.index') }}"> Back</a>
              </div>
          </div> -->
          <div class="page-title-actions">
              <div class="d-inline-block dropdown">
                  <a class="btn btn-primary mr-3 " target="_blank" href="{{ route('geratePdfSows',$sow->id) }}">
                    Print</a>
                    <a class="btn btn-primary"  href="<?php echo $_SERVER['HTTP_REFERER'] ?>">
                    Back
                  </a>
              </div>
                  
              
          </div>
      </div>
  </div>
  <div id="accordion">
      <div class="card">
          <div class="card-header" id="headingOne"  data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <h5 class="mb-0">
              <h3>
                  AMENDMENT
              </h3>
              <div  style="float: right;flex: auto;">
                  <button class="btn btn-link pull-right">
                      <i class="fa fa-angle-down"></i>
                  </button>
              </div>
            </h5>
          </div>

          <div id="collapseOne" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body"> 
                @include('sows.amendmentViewFields')
              </div>
          </div>
      </div>
  </div>


  @section('modals')
  <div id="commentModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Comments</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form method="post">
                      {!! Form::hidden('sow_id',$sow->id) !!}
                      {!! Form::hidden('user_id',Auth::user()->id) !!}
                      @if(Auth::user()->getRoleNames()->search('creator')===false)
                          <div class="form-group">
                              <label for="edit-taunt">Comment</label>
                              <textarea name="post-body" id="post-body" rows="5" class="form-control"></textarea>
                          </div>
                      @endif
                  </form>
                  <div class="comments-list col-sm-12 border-l-r d-none" id="comments-list"></div>              
              </div>
              
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  @if(Auth::user()->getRoleNames()->search('creator')===false)
                      <button type="button" class="btn btn-primary" id="comment-save">Save changes</button>
                  @endif
              </div>
          </div>
      </div>
  </div>
  @endsection

 