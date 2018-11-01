  var marker;
  var locations;
  var base_url = "http://"+window.location.host+"/AppProfil/";
  var url_string = window.location.href;
  var url = new URL(url_string);
  var search_id = window.location.search;
  var id = url.searchParams.get("id");
  var menu_id;

  $(document).ready(function() {
    $("#AppDashboard").attr('href',url_string);
  });

  function load_page(c,d = null){
    $.ajax({
      url: base_url+c+search_id,
      type: "GET",
      dataType: "html",
      success : function(data){
        $("#main-content").html(data);
        $(".breadcrumb_item").remove();
        menu_id = d;
        load_page_info(c);
      },
      error : function(jqXHR, exception){
        if (jqXHR.status == 404) {
          $.ajax({
            url: base_url+"error/error404",
            type: "GET",
            dataType: "html",
            success :function(data){
              $("#main-content").html(data);
              $(".breadcrumb_item").remove();
              $("h1").append('<small class="active breadcrumb_item">error 404</small>');
              $(".breadcrumb").append('<li class="active breadcrumb_item">error 404</li>');
            }
          })
        }
      }
    })    
  }

  function load_page_info(c){
    $.ajax({
      url: base_url + c + "/page_info",
      type: "GET",
      dataType: "JSON",
      success: function(data){
        $.each(data.breadcrumb_item,function(index, el) {
          $("h1").append('<small class="active breadcrumb_item">'+el+'</small>');
          $(".breadcrumb").append('<li class="active breadcrumb_item">'+el+'</li>');
        }); 
      }
    })    
  }