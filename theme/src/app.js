// Imports

import $ from "jquery";
import 'bootstrap';
import 'metismenu';
import 'metismenu';
import 'jsgrid';
import 'jquery-ui';
import 'jquery-ui/ui/core';
import 'jquery-ui/ui/widgets/datepicker';
import 'datatables.net-bs4';
import 'summernote/dist/summernote-bs4';
import 'jquery-ui/themes/base/core.css';
import 'jquery-ui/themes/base/theme.css';
import 'jquery-ui/themes/base/datepicker.css';
import 'jsgrid/dist/jsgrid.min.css';
import 'jsgrid/dist/jsgrid-theme.min.css';
import 'datatables/media/css/jquery.dataTables.min.css';
import 'datatables.net-bs4/css/dataTables.bootstrap4.min.css';
import 'summernote/dist/summernote-bs4.css'; 

//import 'typeahead/typeahead';

// Stylesheets

import './assets/base.scss';

$(document).ready(() => {


    // Sidebar Menu
    
    setTimeout(function () {
        $(".vertical-nav-menu").metisMenu();
    }, 100);

    // Search wrapper trigger

    $('.search-icon').click(function () {
        $(this).parent().parent().addClass('active');
    });

    $('.search-wrapper .close').click(function () {
        $(this).parent().removeClass('active');
    });

    // Stop Bootstrap 4 Dropdown for closing on click inside

    $('.dropdown-menu').on('click', function (event) {
        var events = $._data(document, 'events') || {};
        events = events.click || [];
        for (var i = 0; i < events.length; i++) {
            if (events[i].selector) {

                if ($(event.target).is(events[i].selector)) {
                    events[i].handler.call(event.target, event);
                }

                $(event.target).parents(events[i].selector).each(function () {
                    events[i].handler.call(this, event);
                });
            }
        }
        event.stopPropagation(); //Always stop propagation
    });

    $(function () {
        $('[data-toggle="popover"]').popover();
    });

    // BS4 Tooltips

    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $('.mobile-toggle-nav').click(function () {
        $(this).toggleClass('is-active');
        $('.app-container').toggleClass('sidebar-mobile-open');
    });

    $('.mobile-toggle-header-nav').click(function () {
        $(this).toggleClass('active');
        $('.app-header__content').toggleClass('header-mobile-open');
    });

    // Responsive

    var resizeClass = function () {
        var win = document.body.clientWidth;
        if (win < 1250) {
            $('.app-container').addClass('closed-sidebar-mobile closed-sidebar');
        } else {
            $('.app-container').removeClass('closed-sidebar-mobile closed-sidebar');
        }
    };

    $(window).on('resize', function () {
        resizeClass();
    });

    resizeClass();

    //Custom changes jsgrid and datepicker sommernote

    if($(".texteditor").length > 0) {
        $('.texteditor').summernote({
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']],
            ]
        });
    }

    function applyRangePicker(startDateObj, endDateObj) {
        
        $( function() {
          var dateFormat = "yy-mm-dd",
            from = startDateObj
              .datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                changeYear: true,
                dateFormat: "yy-mm-dd"
              })
              .on( "change", function() {
                to.datepicker( "option", "minDate", getDate( this ) );
              }),
            to = endDateObj.datepicker({
              defaultDate: "+1w",
              changeMonth: true,
              changeYear: true,
              dateFormat: "yy-mm-dd"
            })
            .on( "change", function() {
              from.datepicker( "option", "maxDate", getDate( this ) );
            });

          function getDate( element ) {
            var date;
            try {
              date = $.datepicker.parseDate( dateFormat, element.value );
            } catch( error ) {
              date = null;
            }

            return date;
          }
        } );
    }
  
    if($("#team_composition_table").length > 0) {
        var sowId = $("#team_composition_table").attr('data-sow-id');
        var state = $("#team_composition_table").attr('data-state');
        $("#team_composition_table").jsGrid({
            width: "100%",
            height: "auto",
            controller: {
               updateItem: function(item) {
                   var d = $.Deferred();
                        $.ajax({
                            type: "PUT",
                            dataType: "json",
                            contentType: "application/json; charset=utf-8",
                            url: "/api/sow_team_compositions/"+item.id,
                            data: JSON.stringify(item)
                        }).done(function (response, textStatus, errorThrown) {
                            d.resolve(response);


                        }).fail(function (xhr, exception) {

                        });
                        return d.promise();
               },
               insertItem: function (item) {
                $("#error_team_composition").html(''); 
                   item.sow_id = sowId;
                   var d = $.Deferred();
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            contentType: "application/json; charset=utf-8",
                            url: "/api/sow_team_compositions",
                            data: JSON.stringify(item)
                        }).done(function (response, textStatus, errorThrown) {
                            d.resolve(response);
                            $("#error_team_composition").html(''); 
                        }).fail(function (xhr, exception) {

                        });
                        return d.promise();
               },
               deleteItem: function (item) {
                   var d = $.Deferred();
                        $.ajax({
                            type: "DELETE",
                            dataType: "json",
                            contentType: "application/json; charset=utf-8",
                            url: '/api/sow_team_compositions/' + item.id,
                            data: JSON.stringify(item)
                        }).done(function (response, textStatus, errorThrown) {
                            d.resolve(response);


                        }).fail(function (xhr, exception) {

                        });
                        return d.promise();

               },
               loadData: function() {
                   let data = loadData();
                   let rows = data.itemsLength;
                   $("[name='team_composition_rows']").val(rows);
                   return data;
               }
            },
            onDataLoaded: function(args) {
                setTimeout(function () {
                    let startDateDOM = $(args.grid._header).find("table.jsgrid-table tr.jsgrid-insert-row td.start_date input[type=text]");
                    let endDateDOM = $(args.grid._header).find("table.jsgrid-table tr.jsgrid-insert-row td.end_date input[type=text]");
                        if(startDateDOM.length > 0 && endDateDOM.length > 0) {
                            startDateDOM.prop("readonly", true);
                            endDateDOM.prop("readonly", true);

                            //rangepicker for addItem
                            applyRangePicker(startDateDOM, endDateDOM);
                        }
                }, 5);
            },
            onItemEditing: function(args) {
                setTimeout(function () {
                    let startDateDOM = $(args.row).closest('tbody').find('tr.jsgrid-edit-row td.start_date input[type=text]');
                    let endDateDOM = $(args.row).closest('tbody').find('tr.jsgrid-edit-row td.end_date input[type=text]');
                    if(startDateDOM.length > 0 && endDateDOM.length > 0) {
                        startDateDOM.prop("readonly", true);
                        endDateDOM.prop("readonly", true);
                        
                        //rangepicker for editItem
                        applyRangePicker(startDateDOM, endDateDOM);
                    }
                }, 5);
            },
            inserting: (state === 'active' ? true : false),
            editing: (state === 'active' ? true : false),
            paging: true,
            pageLoading: true,
            noDataContent: function () {
                return "No Data Found";
            },
            autoload: true,
            fields: [
                {name: "role_id", title:"Role", type: "select", items: getProjectRoleData(), valueField: "id", textField: "name", validate: "required"},
                {name: "skill_id", title:"Skill", items: getProjectSkillData(), valueField: "id", textField: "name", type: "select", validate: "required"},
                {name: "qty", title:"Qty", type: "text", width: 50, 
                validate: {
                    validator: "pattern",
                    param: "[1-9]",
                    message: "field is invalid"
                  }
                },
                {name: "start_date", title:"Start Date", type: "text", sorting: false, css: 'start_date', validate: "required"},
                {name: "end_date", title: "End Date", type: "text", sorting: false, css: 'end_date', validate: "required"},
                (state === 'active')?{name: "control", type: "control", 
                    insertTemplate: function() { return getCustomInsertControls("#team_composition_table")}
                }:''                
            ],
            invalidNotify: function(args) { },
            onItemInvalid: function(args) {
                var errorstr = '';
                $.each(args.errors, function (i, item) {
                  if(item.message != undefined)  
                  errorstr += item.field.title+" "+item.message.toLowerCase()+".<br>";
                });
                $("#error_team_composition").html(errorstr);              
            }
        });
        
        function getCustomInsertControls(gridId) {
            let grid = $(gridId).data("JSGrid");
            return $("<input>").addClass("btn")
                    .addClass("btn-primary").val("Save")
                    .css('padding','inherit')
                    .attr({
                        type: "button"
                    })
                    .on("click", function () {
                        grid.insertItem().done(function () {
                            grid.option("inserting", false);
                            $(gridId).jsGrid("clearInsert");
                        });
                    });
        }
        
        function loadData() {
            var response = $.ajax({
                url: "/api/sow_team_compositions/"+sowId,
                type: 'GET',
                async: false
            }).responseJSON;
            var data = [];
            $.each(response, function(i) {
                data.push(response[i]);
            });
            return {
                data: data,
                itemsLength: data.length
            };
        }
        function getProjectRoleData() {
            let data = $.ajax({
                url: '/api/project_roles',
                type: 'GET',
                 dataType: 'JSON',
                 async: false
             }); 
             return data.responseJSON;
        }

        function getProjectSkillData() {
            let data = $.ajax({
                url: '/api/project_skills',
                type: 'GET',
                 dataType: 'JSON',
                 async: false
             });
             return data.responseJSON;
        }
    }
    
    if($("#agree_date").length > 0) {
        $('#agree_date').datepicker({
          dateFormat: "yy-mm-dd",
          changeMonth: true,
          changeYear: true,
          minDate: new Date()
        });
    }
  
    if($("#start_date").length > 0 && $("#end_date").length > 0) {
        //rangepicker for Dates field
        applyRangePicker($( "#start_date" ), $( "#end_date" ));    
    }
  
    $("#nextBtnStepOne").on( "click", function() { 
        if( ($("#project_type_id option:selected").val() != $(this).data("protypeold"))  && $("#project_type_id option:selected").val() != '' && $(this).data("protypeold") != ''){
              var result = confirm("Changing project will overwrite some information. Do you want to continue?");
              if (result) {
                  $( "#formstepone" ).submit();
              }
          }
          else $( "#formstepone" ).submit();
    });
    
    //Custom Changes for Comment button

    $(".commentable").mouseenter(function() {
      var r= $('<button id="commentbtn" type="button" class="btn-shadow btn btn-success"><i class="pe-7s-comment"></i></button>');
      $(this).append(r);
    });

    $(".commentable").mouseleave(function() {
      $( "#commentbtn" ).remove();
    });
  
    $('.commentable').on("click", "#commentbtn", function(){
      $("#commentModal").modal('show');
      $("#post-body").val("");
      $('#comments-list').empty(); 
      var element = $(this).parent().attr('data-comment-for');
      var sow = $('[name="sow_id"]').val();
      $.ajax(
      {
          type: "GET",
          url:  '/api/attribute_comment/' + sow +'/' + element,
          data: "{}",
          contentType: "application/json; charset=utf-8",
          dataType: "json",
          cache: false,
          success: function (data) {

          var trHTML = '<div class="scrolling-wrapper">';

          $.each(data, function (i, item) {
             
            trHTML += '<div class="media">' + 
                      ' <p class="pull-right"><small>'+ item["created_at"] +'</small></p>' +
                      ' <div class="media-body">' +
                      '   <h4 class="media-heading user_name">' + item["user"]["name"] + '</h4>' +
                      '<span> ' + item["comments"] + '</span>' +
                      ' </div>' +
                      '</div>';
          });
          trHTML += '</div>';
          $('#comments-list').empty(); 
          if(data.length>0){
            $('#comments-list').removeClass("d-none");
          }
          else{
            $('#comments-list').addClass("d-none");
          }
          $('#comments-list').append(trHTML);
          
          },
          error: function (msg) {              
              alert(msg.responseText);
          }
      });
      $("#commentModal").attr( 'data-attribute-id', element  );
    });

    $('#comment-save').on('click',function(){
        var item = {
                  "sow_id":$('[name="sow_id"]').val(), 
                  "user_id":$('[name="user_id"]').val(),
                  "comments":$("#post-body").val(),
                  "attribute":$("#commentModal").attr('data-attribute-id'),
                } ;
        $("#comment-save").attr("disabled", true);
        var d = $.Deferred();
        $.ajax({
          type: "POST",
          dataType: "json",
          contentType: "application/json; charset=utf-8",
          url: "/api/attribute_comment",
          data: JSON.stringify(item)
        }).done(function (response, textStatus, errorThrown) {
          d.resolve(response);
          $("#commentModal").modal('hide');

          var trHTML = '<div class="scrolling-wrapper">';

          $.each(response, function (i, item) {
             
            trHTML += '<div class="media">' + 
                      ' <p class="pull-right"><small>'+ item["created_at"] +'</small></p>' +
                      ' <div class="media-body">' +
                      '   <h4 class="media-heading user_name">' + item["user"]["name"] + '</h4>' +
                      '<span> ' + item["comments"] + '</span>' +
                      ' </div>' +
                      '</div>';
          });
          trHTML += '</div>';

          var commentfor = $("#commentModal").attr('data-attribute-id');
          var element = $("div").find(`[data-comment-for='${commentfor}']`).siblings(".comments-list");
          $(element).empty();
          $(element).removeClass("d-none");
          $(element).append(trHTML);
          $("#post-body").val("");
          $("#comment-save").attr("disabled", false);
        }).fail(function (xhr, exception) {
            $("#comment-save").attr("disabled", false);
        });
        return d.promise();
    });

        
    //Custom Changes for COMMENTABLE Comment button

    $(".commentable-comment").mouseenter(function() {
        var r= $('<button id="commentbtn" type="button" class="btn-shadow btn btn-success"><i class="pe-7s-comment"></i></button>');
        $(this).append(r);
      });
  
      $(".commentable-comment").mouseleave(function() {
        $( "#commentbtn" ).remove();
      });
    
      $('.commentable-comment').on("click", "#commentbtn", function(){
        $("#commentModal").modal('show');
        $("#post-body").val("");
        $('#comments-list').empty(); 
        //var element = $(this).parent().attr('data-comment-for');
        //var sow = $('[name="sow_id"]').val();
        var commentId = $(this).parent().attr('data-comment-id');
        
        $.ajax(
        {
            type: "GET",
            url:  '/api/attribute_comment_by_cid/' + commentId,
            data: "{}",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            cache: false,
            success: function (data) {
  
            var trHTML = '<div class="scrolling-wrapper">';
            var element = "";
            var sow = "";
            
            $.each(data, function (i, item) {
               
              trHTML += '<div class="media">' + 
                        ' <p class="pull-right"><small>'+ item["created_at"] +'</small></p>' +
                        ' <div class="media-body">' +
                        '   <h4 class="media-heading user_name">' + item["user"]["name"] + '</h4>' +
                        '<span> ' + item["comments"] + '</span>' +
                        ' </div>' +
                        '</div>';
                element = item["attribute"];
                sow = item["sow_id"];
            });
            trHTML += '</div>';
            $('#comments-list').empty(); 
            if(data.length>0){
              $('#comments-list').removeClass("d-none");
            }
            else{
              $('#comments-list').addClass("d-none");
            }
            $('#comments-list').append(trHTML);
            $("#commentModal").attr( 'data-attribute-id', element  );
            },
            error: function (msg) {              
                alert(msg.responseText);
            }
        });
        //$("#commentModal").attr( 'data-attribute-id', element  );
      });

      $('#commentable-comment-save').on('click',function(){
        var item = {
                  "sow_id":$('[name="sow_id"]').val(), 
                  "user_id":$('[name="user_id"]').val(),
                  "comments":$("#post-body").val(),
                  "attribute":$("#commentModal").attr('data-attribute-id'),
                } ;
        $("#commentable-comment-save").attr("disabled", true);
        var d = $.Deferred();
        $.ajax({
          type: "POST",
          dataType: "json",
          contentType: "application/json; charset=utf-8",
          url: "/api/attribute_comment",
          data: JSON.stringify(item)
        }).done(function (response, textStatus, errorThrown) {
          d.resolve(response);
          $("#commentModal").modal('hide');

          var trHTML = '<div class="scrolling-wrapper">';
          var commentID ="";
          $.each(response, function (i, item) {
             
            trHTML += '<div class="media commentable-comment" data-comment-id="'+item["id"]+'">' + 
                      ' <p class="pull-right"><small>'+ item["created_at"] +'</small></p>' +
                      ' <div class="media-body">' +
                      '   <h4 class="media-heading user_name">' + item["user"]["name"] + '</h4>' +
                      '<span> ' + item["comments"] + '</span>' +
                      ' </div>' +
                      '</div>';
            commentID = item["id"];
          });
          trHTML += '</div>';
          //console.log(commentID);
          var commentfor = commentID ; //$("#commentModal").attr('data-attribute-id');
          var element = $("div").find(`[data-comment-id='${commentfor}']`).parent(".scrolling-wrapper").parent(".comments-list");
          
          //console.log(element);
          $(element).empty();
          $(element).removeClass("d-none");
          $(element).append(trHTML);
          $("#post-body").val("");
          $("#commentable-comment-save").attr("disabled", false);
        }).fail(function (xhr, exception) {
            $("#commentable-comment-save").attr("disabled", false);
        });
        return d.promise();
    });


    //Custom Code for Datatables
    // Manager Datatables
    ManagerDatatables();
    function ManagerDatatables()
    {
         $('#ManagerDatatables').DataTable({
             "destroy":true,
             "processing": true,
             "serverSide": true,
             "order": [[ 1, "desc" ]],
             "columnDefs": [ { orderable: false, targets: [0, 3] } ],
             "searching": false,
             "ajax":{
                     "type": "POST",
                     "url": 'managerdt',
                     "dataType": "json",
                     "data":{name:$('#s_b_name').val(),mtype:$("#s_b_type option:selected").val()},
                     "headers": {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 },
             "columns": [
                     { "data": "id","orderDataType": "dom-text", "type": "numeric"  },   
                     { "data": "name" },
                     { "data": "type" },
                     { "data": "options" }
             ],
         });
    }      
    $(document).on('change','#s_b_type',function()
    {
        ManagerDatatables();
    });
    
    $(document).on('keyup','#s_b_name',function()
    {
        ManagerDatatables();
    });   

    // Project Role Datatables
    $('#ProjectRoleDatatables').DataTable({
         "processing": true,
         "serverSide": true,
         "columnDefs": [ { orderable: false, targets: [0, 2] } ],
         "order": [[ 1, "desc" ]],
         "language": {
             "searchPlaceholder": "Search Name"
         },
         "ajax":{
                 "type": "POST",
                  "url": 'projectroledt',
                  "dataType": "json",
                  "headers": {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
                },
         "columns": [
                 { "data": "id",},   
                 { "data": "name" },
                 { "data": "options" }
         ],
    });

    //Location Datatables
    $('#locationDatatables').DataTable({
        "processing": true,
        "serverSide": true,
        "columnDefs": [ { orderable: false, targets: [0, 2] } ],
        "order": [[ 1, "desc" ]],
        "ajax":{
            type:"POST",
            url:"locationdt",
            dataType:"JSON",
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        "columns":[
            {"data":"id"},
            {"data":"type"},
            {"data":"action"}
        ], 
    });
      
    $('#RoleDatatables').DataTable({
        processing:true,
        serverSide:true,
        columnDefs: [ { orderable: false, targets: [0, 2] } ],
        order: [[ 1, "desc" ]],
        ajax:{
            type:'post',
            url:'roledt',
            dataType:"JSON",
            headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
        columns:[
            {"data":"id"},
            {"data":"name"},
            {"data":"action"}
        ]
    });

    $('#SkillDatatable').DataTable({
        processing:true,
        serverSide:true,
        columnDefs: [ { orderable: false, targets: [0, 2] } ],
        order: [[ 1, "asc" ]],
        ajax:{
            type:'post',
            url:'skilldt',
            dataType:"JSON",
            headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
        columns:[
            {"data":"id"},
            {"data":"name"},
            {"data":"action"}
        ]        
    });

    $('#PermissionDatatables').DataTable({
        processing:true,
        serverSide:true,
        columnDefs: [ { orderable: false, targets: [0, 2] } ],
        order:[[1, "asc"]],
        ajax:{
            type:'post',
            url:'permissiondt',
            dataType:'JSON',
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        },
        columns:[
            {"data":"id"},
            {"data":"name"},
            {"data":"action"}
        ]
    });

    $('#ProcuringDatatables').DataTable({
        serverSide:true,
        processing:true,
        columnDefs:[{orderable:false, targets:[0, 2 ]}],
        order:[[1, "asc"]],
        ajax:{
            type:'post',
            url:'procuringdt',
            dataType:'JSON',
            headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}
        },
        columns:[
            {'data':'id'},
            {'data':'name'},
            {'data':'action'}
        ]
    });

    SowHeaderDatatables();
    function SowHeaderDatatables(){
    $('#SowHeaderDatatables').DataTable({
            "destroy":true,
            "processing": true,
            "serverSide": true,
            "order": [[ 1, "desc" ]],
            "columnDefs": [ { orderable: false, targets: [0, 2] } ],
            "searching": false,
            "ajax":{
                "type":'post',
                "url":'sow_headerdt',
                "dataType":'JSON',
                "data":{h_name:$('#h_name').val(),ptype:$("#p_type option:selected").val()},
                "headers":{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}
            },
            "columns":[
                    {'data':'id'},
                    {'data':'type'},
                    {'data':'header_name'},
                    {'data':'action'}
            ]
        });
    }

    $('#ProjectTypeDatatables').DataTable({
        serverSide: true,
        processing:true,
        columnDefs:[{orderable:false, targets:[0, 2]}],
        order:[[1, "asc"]],
        ajax:{
            type:'post',
            url:'project_typedt',
            dataType:'JSON',
            headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}
        },
        columns:[
                {'data':'id'},
                {'data':'type'},
                {'data':'action'}
        ]
    });
    $(document).on('change','#p_type',function()
    {
        SowHeaderDatatables();
    });
    $(document).on('keyup','#h_name',function()
    {
        SowHeaderDatatables();
    });   
    
    $(document).on('keyup','#s_b_name',function()
    {
        ManagerDatatables();
    });         

    $('#project_type_id').change(function(){
        $.ajax(
            {
                type: "GET",
                url:  '/api/project_header/'+$('#project_type_id option:selected').val(),
                data: "{}",
                contentType: "application/json; charset=utf-8",
                // dataType: "json",
                cache: false,
                success: function (data) {
                   $("#header_desc").html(data);
                },
                error: function (msg) {    
                    alert(msg.responseText);
                }
            });
    });

    //For Role Admin panel default selection based on dependency
    $('#access_matrix tr td input.create').on("click", function(){
        if($(this).prop("checked") == true){
          $(this).parent().siblings('td').find('input.list').prop('checked', true);
        }
        else{
          $(this).parent().siblings('td').find('input.list').prop('checked', false);
        }
    });

    $('#access_matrix tr td input.delete').on("click", function(){
        if($(this).prop("checked") == true){
          $(this).parent().siblings('td').find('input.list').prop('checked', true);
          $(this).parent().siblings('td').find('input.create').prop('checked', true);
        }
        else{
          $(this).parent().siblings('td').find('input.list').prop('checked', false);
          $(this).parent().siblings('td').find('input.create').prop('checked', false);
        }
    });

    $('#access_quest tr td label input.review').on("click", function(){
        if($(this).prop("checked") == true){
          $('#access_matrix tr td input.list.sow').prop('checked', true);
        }
        else{
          $('#access_matrix tr td input.list.sow').prop('checked', false);
        }
    });

    $('#access_quest tr td label input.approve').on("click", function(){
        if($(this).prop("checked") == true){
          $('#access_matrix tr td input.list.sow').prop('checked', true);
        }
        else{
          $('#access_matrix tr td input.list.sow').prop('checked', false);
        }
    });

    // timeout set for all session notification message
    (function($){
        setTimeout(function() { 
               $('.alert').fadeOut(); 
           }, 5000);
         })($); 
    /* Alert to save form before page change*/
        var unsaved = false;
        $("input, textarea, select,checkbox, radio").change( function() {
            unsaved = true;
        });
        $(document).on('change paste', '.excludeform input, textarea, select,checkbox, radio', function () { 
            unsaved = false;
        });
        $(document).on('submit',  function () {
            unsaved = false;
        });
        $(".texteditor").on("summernote.change", function (e) { 
            unsaved = true;
        });
        function unloadPage() {
            if (unsaved) {
                return "You have unsaved changes on this page.";
            }
        }
        window.onbeforeunload = unloadPage;
     /* Alert to save form before page change*/
        /* Change control */
        if($("#change_control").length > 0) {
            $('#change_control').summernote({
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['para', ['ul', 'ol', 'paragraph']],
                ]
            });
    
            $('#change_control').summernote('disable');
    
            $( "#add-control-change-btn" ).click(function() {
                $('#change_control_div').toggle();
                $(this).text(function(i, text){
                    return text === "Add" ? "Cancel" : "Add";
                })
                $('#change_control').summernote('enable');
            });
        }
         /* Change control */
    
       /* Typeahead*/
    // $('#sow_id').typeahead({
    //     source: function (query, result) { 
    //         $.ajax({
    //             url: '/api/sow_list/'+$("#queryInput").val(),
    //             data: 'query=' + query,        
    //             dataType: "json",
    //             type: "POST",
    //             success: function (data) {         
    //                result($.map(data, function (item) {
    //                     return item['label'];
    //                 }));
    //             }
    //         }); 
    //     },
    //     select: function( event, ui ) { alert(event);
    //       $("#sowid").val(ui);
    //     //  return false;
    //     },     
    // });

    
/* End of Typeahead*/

// Amendment

    if($("#effective_from").length > 0) {
        $('#effective_from').datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        //minDate: new Date()
        });
    }
    if($("#dated").length > 0) {
        $('#dated').datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        //minDate: new Date()
        });
    }
    if($("#original_end_date").length > 0) {
        $('#original_end_date').datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        //minDate: new Date()
        });
    }
    if($("#revised_end_date").length > 0) {
        $('#revised_end_date').datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        //minDate: new Date()
        });
    }


 });
