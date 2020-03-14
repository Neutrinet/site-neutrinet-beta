---
title: Challenge
body_classes: title-center header-transparent sticky-footer
cache_enable: false
process:
    twig: true
forms:
    select-hiker:
        action: /mgc
        fields:
            - name: hiker
              type: hidden
            - name: hiked
              type: hidden
            - name: hiker_id
              type: hidden
            - name: hidden
              type: hidden
              default: "no"
        buttons:
            - type: submit
              value: Select Hiker
            - type: reset
              value: Deselect Hiker
            - type: submit
              value: Hide Table
              task: show
        process:
            - mgc: true
    show-hikers:
        action: /mgc
        fields:
            - name: hidden
              type: hidden
              default:  "no"
        buttons:
            - type: submit
              task: show
              value: Show Hiker Table
        process:
            - mgc: true
    change-map-style:
        action: /mgc
        fields:
            - name: style
              type: select
              label: 'Map Style'
              options:
                    outdoors: Outdoors
                    transport: Show Transport
                    transport-dark: Transport Dark
                    landscape: Landscape
                    mobile-atlas: Mobile Optimised
              default: outdoors
        process:
            - mgc: true
    update-hikes-form:
        action: /mgc
        fields:
            - name: peak
              type: hidden
            - name: peak_name
              type: display
              label: Peak reached
            - name: hiker
              type: hidden
            - name: hiked
              type: hidden
            - name: hiker_name
              type: hidden
            - name: done
              type: hidden
            - name: group
              type: select
              label: "Which type of hike was this?"
              help: "If not a meetup group, then self-guided. Please provide selfie at top."
              options:
                    'Meetup': 'Meetup Group'
                    'Self-guided': 'Self Guided'
            - name: meetuphike
              type: text
              validation:
                    required: true
            - name: images
              type: file
              label: 'Images of hike (jpeg/jpg/png)'
              multiple: true
              destination: user/images
              help: "Image(s) of your hike. Obligatory for self-guided. Only jpeg & png formats accepted"
              accept: [ 'image/jpeg', 'image/jpg', 'image/png' ]
        buttons:
            - type: submit
              value: Update peak
            - type: reset
              value: Reset
        process:
            - mgc-cleanup: true
            - userinfo:
                update: true
                include:
                    - hiked
            - reset: true
---
## Pour information

C'est ce qui vient du [Forum de Grav](https://discourse.getgrav.org/t/multiple-forms-datatables-sqlite-and-map/8289).

{% if userinfo or (mgc and mgc.hiker) %}
## Hiker: {{ (mgc and mgc.hiker)?mgc.hiker:userinfo.hiker }}, Peaks climbed: {{ (mgc and mgc.hiked) ? mgc.hiked : userinfo.hiked }}
{% else %}
## Please login or select hiker
{% endif %}

## Peak Map

[map-leaflet lat=22.387015  lng=114.160555 zoom=11 mapname=mgcpeaks height="600px" style="{{ ( mgc and mgc.style )? mgc.style : '' }}" scale]
[a-markers icon='' iconColor=black ]
[sql-table json]
SELECT latitude as lat, longitude as lng,
printf("%s | %s | %dm",eng_name,cn_name,altitude) as title,
peak_id as text,
CASE
    WHEN t1.hiked > 0 AND t1.inf=1 THEN 'salmon'
    WHEN t1.hiked > 0 AND t1.inf=2 THEN 'pink'
    WHEN t1.hiked > 0 AND t1.inf=3 THEN 'lightblue'
    ELSE 'lightgreen'
    END as markerColor
FROM peaks
LEFT JOIN (
    SELECT trek_id as hiked, peak,
        CASE
            WHEN meetuphike="No info" THEN 1
            WHEN meetuphike="Self-guided" THEN 2
            ELSE 3
        END AS inf
    FROM treks WHERE hiker="{{ mgc.hiker_id?mgc.hiker_id:(userinfo.hiker_id?userinfo.hiker_id:'') }}" ) as t1
ON t1.peak=peaks.peak_id
ORDER BY peak_id ASC
[/sql-table]
[/a-markers]
[/map-leaflet]

<div class="mgc-mk">
    <div style="background: #eb7d7f;">No information</div>
    <div style="background: #ff91ea;">Self-guided</div>
    <div style="background: #88daff;">Registered meetup hike</div>
    <div style="background: #bbf970;">Not hiked yet</div>
</div>
{% set options = {"outdoors": "Outdoors",
"transport": "Show Transport",
"transport-dark": "Transport Dark",
"landscape": "Landscape",
"mobile-atlas": "Mobile Optimised" }
%}

{% include "forms/form.html.twig" with { form: forms('change-map-style') } %}
<script>
$('select[name="data[style]"]').on('change', function() {
    $('#change-map-style').submit();
});
$(document).ready(function() {
    $('option[value="{{ mgc.style }}"]').prop('selected', true);
});
</script>
## Hiker Selection
{% if (mgc and mgc.hidden=="yes") %}
{% include "forms/form.html.twig" with { form: forms('show-hikers') } %}
{% else %}
[datatables]
[sql-table hidden=hiker_id]
SELECT fullname as Hiker, count(t2.peak) as "Peaks Completed", hiker_id  FROM hikers as t1
LEFT JOIN treks  as t2 ON t1.hiker_id=t2.hiker
GROUP BY t1.hiker_id
[/sql-table]
[dt-script]
var table = $(selector).DataTable();
$(selector + ' tbody').on( 'click', 'tr', function () {
    if ( $(this).hasClass('selected') ) {
        $(this).removeClass('selected');
        $('#select-hiker input[name="data[hiker_id]"]').val('');
        $('#select-hiker input[name="data[hiker]"]').val('');
        $('#select-hiker input[name="data[hiked]"]').val('');
    }
    else {
        table.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
        var rd = table.row('.selected').data();
        $('#select-hiker input[name="data[hiker_id]"]').val(rd[2]);
        $('#select-hiker input[name="data[hiker]"]').val(rd[0]);
        $('#select-hiker input[name="data[hiked]"]').val(rd[1]);
    }
} );
$("#select-hiker button").click(function(ev){
    ev.preventDefault();
    if($(this).attr("name")=="task") {
        $('#select-hiker input[name="data[hidden]"]').val("yes");
    } else if ($(this).attr('type') == 'reset') {
        table.$('tr.selected').removeClass('selected');
        $('#select-hiker input[name="data[hiker_id]"]').val(' ');
        $('#select-hiker input[name="data[hiker]"]').val(' ');
        $('#select-hiker input[name="data[hiked]"]').val(' ');
    } else {
        $('#select-hiker input[name="data[hidden]"]').val("no");
    }
    $("#select-hiker").submit();
});
[/dt-script]
[/datatables]

{% include "forms/form.html.twig" with { form: forms('select-hiker') } %}
{% endif %}

## Hike Information

[datatables]
[sql-table hidden="done peaks"]
SELECT peak_id as "Order", eng_name as "English Name", cn_name as "Chinese Name", altitude as "Altitude",
case when t2.hiked > 0 then 1 else 0 end as done,
t3.peaks as peaks,
CASE t2.meetuphike
WHEN 'No info' THEN t2.meetuphike
WHEN 'Self-guided' THEN t2.meetuphike
ELSE '<a href="' || t2.meetuphike || '"  target="_blank">_Meetup Group_</a>'
END as "Hiked with",
t2.images as "Images"
FROM peaks as t1
LEFT JOIN (SELECT trek_id as hiked, peak, meetuphike, images FROM treks
WHERE hiker="{{mgc.hiker_id?:(userinfo.hiker_id?:'')}}") as t2
on t1.peak_id = t2.peak,
(SELECT count(trek_id) as peaks FROM treks
WHERE hiker="{{mgc.hiker_id?:(userinfo.hiker_id?:'')}}") as t3
[/sql-table]
[dt-script]
    var table = $(selector).DataTable();
    table.rows().every( function () {
        var peak = this.data();
        if ( peak[4] == 1 ) {
            $(this.node()).addClass('mgc-hiked');
        }
    });
    $(selector + ' tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
            $('#update-hikes-form input[name="data[peak]"]').val('');
            $('#update-hikes-form input[name="data[hiker]"]').val('');
            $('#update-hikes-form input[name="data[done]"]').val('');
            $('#update-hikes-form input[name="data[hiker_name]"]').val('');
            $('#update-hikes-form input[name="data[hiked]"]').val('');
            $('#update-hikes-form div:first-of-type div:nth-of-type(2) div').html('undefined');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            var rd = table.row('.selected').data();
            $('#update-hikes-form input[name="data[peak]"]').val(rd[0]);
            $('#update-hikes-form input[name="data[hiker]"]').val('{{userinfo.hiker_id}}');
            $('#update-hikes-form input[name="data[done]"]').val(rd[4]);
            $('#update-hikes-form input[name="data[hiker_name]"]').val('{{userinfo.hiker}}');
            var pkdone=rd[5];
            if(rd[4] == 0) { pkdone = +pkdone +1; }
            $('#update-hikes-form input[name="data[hiked]"]').val( pkdone ); // incremented by operation if new
            $('#update-hikes-form div:first-of-type div:nth-of-type(2) div').html(rd[0] + ' - ' +rd[1]+' '+rd[2]+' (' + rd[3] + ')');
        }
    } );
    $('#update-hikes-form').on('reset', function(e) {
        setTimeout( function() {
            table.$('tr.selected').removeClass('selected');
            $('#update-hikes-form input[name="data[peak]"]').val('');
            $('#update-hikes-form input[name="data[done]"]').val('');
            $('#update-hikes-form input[name="data[hiker]"]').val('');
            $('#update-hikes-form input[name="data[hiker_name]"]').val('');
            $('#update-hikes-form input[name="data[hiked]"]').val('');
            $('#update-hikes-form div:first-of-type div:nth-of-type(2) div').html('undefined');
        });
    });
    $('#update-hikes-form select').on('change', function() {
        if ( this.value == "Self-guided") {
            $('#update-hikes-form div.form-group:has(input[name="data[meetuphike]"])').css('display','none');
            $('#update-hikes-form input[name="data[meetuphike]"]').val("Self-guided");
        } else {
            $('#update-hikes-form div.form-group:has(input[name="data[meetuphike]"])').css('display','');
            $('#update-hikes-form input[name="data[meetuphike]"]').val('');
        }
    });
[/dt-script]
[/datatables]
{% if userinfo and (userinfo.hiker == grav.user.fullname)
    and ((mgc and mgc.hiker == userinfo.hiker) or not mgc) %}
{% include "forms/form.html.twig" with { form: forms('update-hikes-form') } %}
{% endif %}

<img id="photo-area" class="mgc-photo"></img>
<script>
$('.mgc-th img').click(function(){
    $('#photo-area').attr('src',$(this).attr('src'));
    });
$('.mgc-th span').click(function() {
    $('#photo-area').attr('src',$(this).attr('data-src'));
    });
$('#photo-area').click(function() { $(this).attr('src',''); });
</script>