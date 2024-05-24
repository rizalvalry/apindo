$(document).ready(function () {
    "use strict";
    $('#navbar_search').on('input', function () {
        var search = $(this).val().toLowerCase();
        var search_result_pane = $('#navbar_search_result_area .navbar_search_result');
        $(search_result_pane).html('');
        if (search.length == 0) {
            return;
        }
        var match = $('#sidebarnav .sidebar-link').filter(function (idx, element) {
            return $(element).text().trim().toLowerCase().indexOf(search) >= 0 ? element : null;
        }).sort();

        if (match.length == 0) {
            $(search_result_pane).append('<li class="text-muted">No search result found.</li>');
            return;
        }
        match.each(function (index, element) {
            var item_url = $(element).attr('href') || $(element).data('default-url');
            var item_text = $(element).text().replace(/(\d+)/g, '').trim();
            $(search_result_pane).append(`<li><a href="${item_url}">${item_text}</a></li>`);
        });
    });

    //youtube video
    let vid_id = $('input[name="youtube_video_id"]').val();
    if (vid_id){
        youtubeVideoPreview(vid_id);
    }

    $(document).on("change keyup", 'input[name="youtube_video_id"]', function () {
        let vid_id = $(this).val();
        youtubeVideoPreview(vid_id);
    });

    function youtubeVideoPreview(vid_id){
        $(".youtube").css({
            "background-image":
                "url(https://img.youtube.com/vi/" + vid_id + "/maxresdefault.jpg)",
            "background-size": "cover",
        });
    }

    $(document).on("click", ".nk-video-plain-toggle", function () {
        var vid_id = $('input[name="youtube_video_id"]').val();
        playVid(vid_id);
    });

    function playVid(video_id) {
        this.isLoadingYoutube = true;
        let youtube = document.querySelector(".youtube");
        let iframe = document.createElement("iframe");

        iframe.setAttribute("frameborder", "0");
        iframe.setAttribute("allowfullscreen", "");
        iframe.setAttribute(
            "src",
            "https://www.youtube.com/embed/" +
            video_id +
            "?rel=0&showinfo=0&autoplay=1"
        );

        this.innerHTML = "";
        youtube.appendChild(iframe);
        this.isLoadingYoutube = false;
    }
});
