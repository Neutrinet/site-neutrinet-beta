---
title: Tryouts
process:
  twig: true
cache_enable: false
forms:
    add_player:
      action: /ag2020/tryout
      fields:  
         - name: team
           type: text
         - name: name
           type: text
         - name: grade
           type: text
         - name: age
           type: text
         - name: phone
           type: text
         - name: parent1
           type: text
         - name: p1phone
           type: text
         - name: p1email
           type: text
         - name: parent2
           type: text
         - name: p2phone
           type: text
         - name: p2email
           type: text
      buttons:
         - type: submit
           value: Add player information
         - type: reset
           value: Reset form
      process:
         - sql-insert:
             table: tryouts
    change_phone:
      action: /ag2020/tryout
      fields: 
         - name: name
           label: Nom
           type: display
         - name: phone
           type: text
           label: Téléphone
         - name: where
           type: hidden
      buttons:
         - type: submit
           value: Update player information
         - type: reset
           value: Reset form
      process:
         - sql-update:
              table: tryouts
---
# Tryout players information
[datatables]
[sql-table hidden=tryoutid]
SELECT tryoutid, team, name, phone, grade, age, parent1, p1phone, p1email, parent2, p2phone, p2email
FROM tryouts
[/sql-table]
[dt-script]
    var table = $(selector).DataTable();
    $(selector + ' tbody').on( 'click', 'tr', function () {
        console.log("clic");
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
            $('#change-phone input[name="data[where]"]').val('');
            $('#change-phone input[name="data[phone]"]').val('');
            $('#change-phone div:first-of-type div:nth-of-type(2) div').html('undefined');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            var rd = table.row('.selected').data();
            $('#change-phone input[name="data[where]"]').val('tryoutid=' + rd[0]);
            $('#change-phone input[name="data[phone]"]').val(rd[3]);
            $('#change-phone div:first-of-type div:nth-of-type(2) div').html(rd[2]);
        }
    } );
    $('#alter-client-form').on('reset', function(e) {
        setTimeout( function() {
            table.$('tr.selected').removeClass('selected');
            $('#change-phone input[name="data[where]"]').val('');
            $('#change-phone input[name="data[phone]"]').val('');
            $('#change-phone div:first-of-type div:nth-of-type(2) div').html('undefined');
        });
    });
[/dt-script]
[/datatables]

!! C'est un test pour sqlite, des formulaires multiples et de d'update de contenu qui vient de [ce post](https://truth2say.blogspot.com/2019/01/tutorial-on-using-sqlite-on-grav.html) issu du [forum de grav](https://discourse.getgrav.org/t/multiple-forms-datatables-sqlite-and-map/8289/10).

# Update player's telephone number

{% include "forms/form.html.twig" with { form: forms('change_phone') } %}

# Add a new player

{% include "forms/form.html.twig" with { form: forms('add_player') } %}

