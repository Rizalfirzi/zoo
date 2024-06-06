function getDataListUser(sid, name) {

    $('#title_search').text("HAISL PENCARIAN DATA: " + name);

    var i = 1;
    var table = $('#table_user').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: 'getSearchResult',
            data: function(d) {
                d.sentiment = $('select[name="sentiment"]').val();
                d.source = $('select[name="source"]').val();
                d.search = $('#searchData').val();
                d.sid = sid
            },
            beforeSend: function(xhr, settings) {

                $('#loading-spinner').show();
                $('#lds-facebook').show();
                $('#lds-facebook-media').show();
            }

        },
        columns: [{
            data: 'media_data',
            name: 'media_data',
            orderable: false
        }, ],
        order: [],

        initComplete: function() {
            $('#loading-spinner').hide();
            $('#lds-facebook').hide();
            $('#lds-facebook-media').hide();
        }
    });
    $(".searchData").keyup(function(e) {
        table.draw();
        e.preventDefault();
        $('#loading-spinner').hide();
        $('#lds-facebook').hide();
        $('#lds-facebook-media').hide();

    });
    $('#filterForm').on('submit', function(e) {
        e.preventDefault();
        table.ajax.reload();
        $('#loading-spinner').hide();
        $('#lds-facebook').hide();
        $('#lds-facebook-media').hide();
    });
    $('#reset').on('click', function() {
        $('select[name="sentiment"]').val('');
        $('select[name="source"]').val('');
        table.ajax.reload();
    });
}
function TabelAnalisisBot(sid, name) {



    var i = 1;
    var table_bot = $('#table_bot').DataTable({
        processing: true,
        serverSide: true,
        lengthMenu: [
            [5, 10, 20, -1],
            [5, 10, 20, 'Todos']
        ],
        ajax: {
            url: 'getBot',
            data: function(d) {
                d.sentiment = $('select[name="sentiment"]').val();
                d.source = $('select[name="source"]').val();
                d.search = $('#searchData').val();
                d.sid = sid
            },
            beforeSend: function(xhr, settings) {

                $('#loading-spinner').show();
                $('#lds-facebook').show();
                $('#lds-facebook-media').show();
            }

        },
        columns: [{
            data: 'author',
            name: 'author',
            orderable: false
        }, {
            data: 'twitter_following',
            name: 'twitter_following',
            orderable: false
        }, {
            data: 'twitter_followers',
            name: 'twitter_followers',
            orderable: false
        }, {
            data: 'selisih',
            name: 'selisih',
            orderable: false
        }, {
            data: 'analisis',
            name: 'analisis',
            orderable: false
        }, ],
        order: [],

        initComplete: function() {
            $('#loading-spinner').hide();
            $('#lds-facebook').hide();
            $('#lds-facebook-media').hide();
        }
    });
    $(".searchData").keyup(function(e) {
        table_bot.draw();
        e.preventDefault();
        $('#loading-spinner').hide();
        $('#lds-facebook').hide();
        $('#lds-facebook-media').hide();

    });
    $('#filterForm').on('submit', function(e) {
        e.preventDefault();
        table_bot.ajax.reload();
        $('#loading-spinner').hide();
        $('#lds-facebook').hide();
        $('#lds-facebook-media').hide();
    });
}
