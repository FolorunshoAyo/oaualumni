
$(document).ready(function () {
    $(function(){
        $('body').on('click','.msgDrop',function(){
            var dtxt = $(this).data('text');
            var di = $(this).data('id');

            var m_title = "";
            var m_body = "";
            var m_footer = "";
            m_title+= "Delete Message";
            m_body+= "<h3>Are you sure you want to <strong class='dltshop_w'>DELETE</strong> this message...? <br> No data can ever be recovered when you delete the <span class='dltshop_w'>Message</span>.</h3>";
            m_body+='<p></p><div class="fdrsgn"></div>';
            m_footer+= '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
            m_footer+='<a href="'+dtxt+'"  class="btn btn-primary cn_dc">Delete Message</a>';

            $('#m_title').text(m_title);
            $('#m_body').html(m_body);
            $('#m_footer').html(m_footer);

            $('#c_mdl').modal('show');

        });
    });

    $(function(){
        $('body').on('click','.newsEventsDrop',function(){
            var dtxt = $(this).data('text');
            var di = $(this).data('id');

            var m_title = "";
            var m_body = "";
            var m_footer = ""
            m_title+= "Delete News/Events";
            m_body+= "<h3>Are you sure you want to <strong class='dltshop_w'>DELETE</strong> this News/Events...? <br> No data can ever be recovered when you delete the <span class='dltshop_w'>News/Events</span>.</h3>";
            m_body+='<p></p><div class="fdrsgn"></div>'
            m_footer+= '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
            m_footer+='<a href="'+dtxt+'"  class="btn btn-primary cn_dc">Delete News/Events</a>';

            $('#m_title').text(m_title);
            $('#m_body').html(m_body);
            $('#m_footer').html(m_footer);

            $('#c_mdl').modal('show');

        });
    });
    $(function(){
            $('body').on('click','.partnerDrop',function(){
            var dtxt = $(this).data('text');
            var di = $(this).data('id');

            var m_title = "";
            var m_body = "";
            var m_footer = ""
            m_title+= "Delete Partner";
            m_body+= "<h3>Are you sure you want to <strong class='dltshop_w'>DELETE</strong> this partner...? <br> No data can ever be recovered when you delete the <span class='dltshop_w'>partner</span>.</h3>";
            m_body+='<p></p><div class="fdrsgn"></div>'
            m_footer+= '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
            m_footer+='<a href="'+dtxt+'"  class="btn btn-primary cn_dc">Delete partner</a>';

            $('#m_title').text(m_title);
            $('#m_body').html(m_body);
            $('#m_footer').html(m_footer);

            $('#c_mdl').modal('show');

        });
    });

    $(function(){

            $('body').on('click','.storyDrop',function(){
            var dtxt = $(this).data('text');
            var di = $(this).data('id');

            var m_title = "";
            var m_body = "";
            var m_footer = ""
            m_title+= "Delete Story";
            m_body+= "<h3>Are you sure you want to <strong class='dltshop_w'>DELETE</strong> this story...? <br> No data can ever be recovered when you delete the <span class='dltshop_w'>story</span>.</h3>";
            m_body+='<p></p><div class="fdrsgn"></div>'
            m_footer+= '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
            m_footer+='<a href="'+dtxt+'"  class="btn btn-primary cn_dc">Delete story</a>';

            $('#m_title').text(m_title);
            $('#m_body').html(m_body);
            $('#m_footer').html(m_footer);

            $('#c_mdl').modal('show');

        })
    });
    $(function(){
            $('body').on('click','.videoDrop',function(){
            var dtxt = $(this).data('text');
            var di = $(this).data('id');

            var m_title = "";
            var m_body = "";
            var m_footer = ""
            m_title+= "Delete Video";
            m_body+= "<h3>Are you sure you want to <strong class='dltshop_w'>DELETE</strong> this video...? <br> No data can ever be recovered when you delete the <span class='dltshop_w'>video</span>.</h3>";
            m_body+='<p></p><div class="fdrsgn"></div>'
            m_footer+= '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
            m_footer+='<a href="'+dtxt+'"  class="btn btn-primary cn_dc">Delete video</a>';

            $('#m_title').text(m_title);
            $('#m_body').html(m_body);
            $('#m_footer').html(m_footer);

            $('#c_mdl').modal('show');

        });
    });
    $(function(){
        $('body').on('click','.tenderDrop',function(){
            var dtxt = $(this).data('text');
            var di = $(this).data('id');

            var m_title = "";
            var m_body = "";
            var m_footer = ""
            m_title+= "Delete Tender";
            m_body+= "<h3>Are you sure you want to <strong class='dltshop_w'>DELETE</strong> this tender...? <br> No data can ever be recovered when you delete the <span class='dltshop_w'>tender</span>.</h3>";
            m_body+='<p></p><div class="fdrsgn"></div>'
            m_footer+= '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
            m_footer+='<a href="'+dtxt+'"  class="btn btn-primary cn_dc">Delete tender</a>';

            $('#m_title').text(m_title);
            $('#m_body').html(m_body);
            $('#m_footer').html(m_footer);

            $('#c_mdl').modal('show');

        })
    });

    $(function(){
            $('body').on('click','.tenderFileDrop',function(){
            var dtxt = $(this).data('text');
            var di = $(this).data('id');

            var m_title = "";
            var m_body = "";
            var m_footer = ""
            m_title+= "Delete Tender File";
            m_body+= "<h3>Are you sure you want to <strong class='dltshop_w'>DELETE</strong> this tender file...? <br> No data can ever be recovered when you delete the <span class='dltshop_w'>tender file</span>.</h3>";
            m_body+='<p></p><div class="fdrsgn"></div>'
            m_footer+= '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
            m_footer+='<a href="'+dtxt+'"  class="btn btn-primary cn_dc">Delete file</a>';

            $('#m_title').text(m_title);
            $('#m_body').html(m_body);
            $('#m_footer').html(m_footer);

            $('#c_mdl').modal('show');

        })
    });
    $(function(){
            $('body').on('click','.addFiles',function(){
            //var dtxt = $(this).data('text');
            var di = $(this).data('id');
            var csrftocken = $('#csrf'+di).val();
                alert(csrftocken);
            var m_title = "";
            var m_body = "";
            var m_footer = ""
            m_title+= "Add file";
            m_body+= "<div class='row'>";
                m_body+='<div class="col-12">';
                    m_body+='<form action="'+surl+'admin/upload-news-letter-files" method="post" enctype="multipart/form-data" accept-charset="utf-8">';
                        m_body+='<div class="form-group">';
                            m_body+='<input type="file" name="images[]">';
                        m_body+='</div>';
                        m_body+='<div class="form-group">';
                            m_body+='<input type="hidden" name="diletnews" value="'+di+'">';
                            m_body+='<input type="hidden" name="csrf_test_name" value="'+csrftocken+'">';
                            m_body+= '<button type="submit" class="btn btn-primary" >Upload</button>';
                        m_body+='</div>';
                    m_body+='</form>';
                m_body+='</div>';
            m_body+='</div>';

            m_footer+= '<button type="button" class="btn btn-default" data-dismiss="modal">Upload</button>';

            $('#m_title').text(m_title);
            $('#m_body').html(m_body);
            $('#m_footer').html(m_footer);

            $('#c_mdl').modal('show');

        })
    });
    $(function(){
            $('body').on('click','.pressClipDrop',function(){
            var dtxt = $(this).data('text');
            var di = $(this).data('id');

            var m_title = "";
            var m_body = "";
            var m_footer = ""
            m_title+= "Delete Tender File";
            m_body+= "<h3>Are you sure you want to <strong class='dltshop_w'>DELETE</strong> this press clip...? <br> No data can ever be recovered when you delete the <span class='dltshop_w'>press clip</span>.</h3>";
            m_body+='<p></p><div class="fdrsgn"></div>'
            m_footer+= '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
            m_footer+='<a href="'+dtxt+'"  class="btn btn-primary cn_dc">Delete press clip</a>';

            $('#m_title').text(m_title);
            $('#m_body').html(m_body);
            $('#m_footer').html(m_footer);

            $('#c_mdl').modal('show');

        })
    });

    $(function(){

            $('body').on('click','.galleryImageDrop',function(){
            var dtxt = $(this).data('text');
            var di = $(this).data('id');

            var m_title = "";
            var m_body = "";
            var m_footer = ""
            m_title+= "Delete Gallery Image";
            m_body+= "<h3>Are you sure you want to <strong class='dltshop_w'>DELETE</strong> this image...? <br> No data can ever be recovered when you delete the <span class='dltshop_w'>image</span>.</h3>";
            m_body+='<p></p><div class="fdrsgn"></div>'
            m_footer+= '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
            m_footer+='<a href="'+dtxt+'"  class="btn btn-primary cn_dc">Delete image</a>';

            $('#m_title').text(m_title);
            $('#m_body').html(m_body);
            $('#m_footer').html(m_footer);

            $('#c_mdl').modal('show');

        });
    });


    $(function(){
            $('body').on('click','.albumDrop',function(){
            var dtxt = $(this).data('text');
            var di = $(this).data('id');

            var m_title = "";
            var m_body = "";
            var m_footer = ""
            m_title+= "Delete Tender";
            m_body+= "<h3>Are you sure you want to <strong class='dltshop_w'>DELETE</strong> this album...? <br> No data can ever be recovered when you delete the <span class='dltshop_w'>album</span>.</h3>";
            m_body+='<p></p><div class="fdrsgn"></div>'
            m_footer+= '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
            m_footer+='<a href="'+dtxt+'"  class="btn btn-primary cn_dc">Delete album</a>';

            $('#m_title').text(m_title);
            $('#m_body').html(m_body);
            $('#m_footer').html(m_footer);

            $('#c_mdl').modal('show');

        })
    });

    $(function(){
            $('body').on('click','.programDrop',function(){
            var dtxt = $(this).data('text');
            var di = $(this).data('id');

            var m_title = "";
            var m_body = "";
            var m_footer = ""
            m_title+= "Delete Program";
            m_body+= "<h3>Are you sure you want to <strong class='dltshop_w'>DELETE</strong> this program...? <br> No data can ever be recovered when you delete the <span class='dltshop_w'>program</span>.</h3>";
            m_body+='<p></p><div class="fdrsgn"></div>'
            m_footer+= '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
            m_footer+='<a href="'+dtxt+'"  class="btn btn-primary cn_dc">Delete program</a>';

            $('#m_title').text(m_title);
            $('#m_body').html(m_body);
            $('#m_footer').html(m_footer);

            $('#c_mdl').modal('show');

        })
    });
    $(function(){
            $('body').on('click','.ResourceDrop',function(){
            var dtxt = $(this).data('text');
            var di = $(this).data('id');

            var m_title = "";
            var m_body = "";
            var m_footer = ""
            m_title+= "Delete Resource";
            m_body+= "<h3>Are you sure you want to <strong class='dltshop_w'>DELETE</strong> this resource...? <br> No data can ever be recovered when you delete the <span class='dltshop_w'>resource</span>.</h3>";
            m_body+='<p></p><div class="fdrsgn"></div>'
            m_footer+= '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
            m_footer+='<a href="'+dtxt+'"  class="btn btn-primary cn_dc">Delete resource</a>';

            $('#m_title').text(m_title);
            $('#m_body').html(m_body);
            $('#m_footer').html(m_footer);

            $('#c_mdl').modal('show');

        })
    });


    $(function(){
            $('body').on('click','.resourceAddFiles',function(){
            var dtxt = $(this).data('text');
            var di = $(this).data('id');

            var m_title = "";
            var m_body = "";
            var m_footer = ""
            m_title+= "Add file";
            m_body+= "<div class='row'>";
            m_body+='<div class="col-12">';
            m_body+='<form action="'+surl+'admin/upload-resource-files" method="post" enctype="multipart/form-data" accept-charset="utf-8">';
            m_body+='<div class="form-group">';
            m_body+='<input type="file" name="image">';
            m_body+='</div>';
            m_body+='<div class="form-group">';
            m_body+='<input type="hidden" name="resourceId" value="'+dtxt+'">';
            m_body+= '<button type="submit" class="btn btn-primary" >Upload</button>';
            m_body+='</div>';
            m_body+='</form>';
            m_body+='</div>';
            m_body+='</div>';

            m_footer+= '<button type="button" class="btn btn-default" data-dismiss="modal">Upload</button>';

            $('#m_title').text(m_title);
            $('#m_body').html(m_body);
            $('#m_footer').html(m_footer);

            $('#c_mdl').modal('show');

        })
    });


    $(function(){
            $('body').on('click','.PressImageDrop',function(){
            var dtxt = $(this).data('text');
            var di = $(this).data('id');

            var m_title = "";
            var m_body = "";
            var m_footer = ""
            m_title+= "Delete Press Image";
            m_body+= "<h3>Are you sure you want to <strong class='dltshop_w'>DELETE</strong> this image...? <br> No data can ever be recovered when you delete the <span class='dltshop_w'>image</span>.</h3>";
            m_body+='<p></p><div class="fdrsgn"></div>'
            m_footer+= '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
            m_footer+='<a href="'+dtxt+'"  class="btn btn-primary cn_dc">Delete image</a>';

            $('#m_title').text(m_title);
            $('#m_body').html(m_body);
            $('#m_footer').html(m_footer);

            $('#c_mdl').modal('show');

        })
    });


    $(function(){
        $('body').on('click','.slidemyDrop',function(){
            var dtxt = $(this).data('text');
            var di = $(this).data('id');

            var m_title = "";
            var m_body = "";
            var m_footer = ""
            m_title+= "Delete Slide";
            m_body+= "<h3>Are you sure you want to <strong class='dltshop_w'>DELETE</strong> this slide...? <br> No data can ever be recovered when you delete the <span class='dltshop_w'>slide</span>.</h3>";
            m_body+='<p></p><div class="fdrsgn"></div>'
            m_footer+= '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
            m_footer+='<a href="'+dtxt+'"  class="btn btn-primary cn_dc">Delete Slide</a>';

            $('#m_title').text(m_title);
            $('#m_body').html(m_body);
            $('#m_footer').html(m_footer);

            $('#c_mdl').modal('show');

        });
    });

    $(function(){
        $('body').on('click','.msgsection',function(){
            var dtxt = $(this).data('text');
            var di = $(this).data('id');

            var m_title = "";
            var m_body = "";
            var m_footer = ""
            m_title+= "Delete Section";
            m_body+= "<h3>Are you sure you want to <strong class='dltshop_w'>DELETE</strong> this Section...? <br> No data can ever be recovered when you delete the <span class='dltshop_w'>Section</span>.</h3>";
            m_body+='<p></p><div class="fdrsgn"></div>'
            m_footer+= '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
            m_footer+='<a href="'+dtxt+'"  class="btn btn-primary cn_dc">Delete Section</a>';

            $('#m_title').text(m_title);
            $('#m_body').html(m_body);
            $('#m_footer').html(m_footer);

            $('#c_mdl').modal('show');

        });
    });


    $(function(){
        $('body').on('click','.homeSectionDrop',function(){
            var dtxt = $(this).data('text');
            var di = $(this).data('id');

            var m_title = "";
            var m_body = "";
            var m_footer = ""
            m_title+= "Delete Section";
            m_body+= "<h3>Are you sure you want to <strong class='dltshop_w'>DELETE</strong> this about Section...? <br> No data can ever be recovered when you delete the <span class='dltshop_w'>About Section</span>.</h3>";
            m_body+='<p></p><div class="fdrsgn"></div>';
            m_footer+= '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
            m_footer+='<a href="'+dtxt+'"  class="btn btn-primary cn_dc">Delete About Section</a>';

            $('#m_title').text(m_title);
            $('#m_body').html(m_body);
            $('#m_footer').html(m_footer);

            $('#c_mdl').modal('show');

        });
    });

    $("#fileID").change(function() {
        readURL(this);
    });

    $('body').on('click','.cntimg',function () {
        $('.previmg').empty();
        $('.xiy').show();
    });


    $('.extnnk').change(function () {
       var externalLink = $(this).val();
       var extfield =  "";
        if (externalLink == 0) {
            $('.extlfiled').empty();
        }
        else if (externalLink == 1) {
            extfield+='<label>Add your external URL</label>';
            extfield+='<input type="text" class="form-control" name="externalUrl" />';
            $('.extlfiled').html(extfield);

        }
    });

    $('.newvidesox').change(function () {
            var newvidesox = $(this).val();
        var extfield =  "";
        if (newvidesox != 'upload') {
            $('.upvideo').hide();
            $('.skzvurlnk').show();

        }
        else {
            $('.upvideo').show();
            $('.skzvurlnk').hide();

        }
    });

});//ready here



function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            var content = '';
            content+='<img src="'+e.target.result+'" id="tagimg" class="img-fluid img-responsive">';
            content+='<br>';
            content+='<a href="javascript:void(0)" class="cntimg">Remove Image</a>';
            $('.previmg').html(content);
            $('.xiy').hide();
            //$('#tagimg').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
