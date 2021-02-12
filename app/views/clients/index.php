<?php
require APPROOT . '/views/includes/head.php';
?>

<div class="navbar dark">
    <?php
    require APPROOT . '/views/includes/navigation.php';
    ?>
</div>

<div class="container">
    <?php if(isLoggedIn()): ?>
    <div>
        <div>
            <center><p>Welcome User: <b>
                        <?php

                        echo $_SESSION['username'];
                        ?>
                    </b></p></center>
        </div>
        <div style="max-width: 200px;">
            <a class="btn green" href="<?php echo URLROOT; ?>/clients/create">
                Create
            </a>
        </div>

    </div>


    <?php endif; ?>

    <?php

    ?>
<!--    --><?php // echo print(json_encode($data['clients']));  ?>

    <script type="text/javascript" charset="utf-8">
        webix.ready(function (){
            var clients_info = <?php  echo json_encode($data['clients']) ?>;
            webix.ui({
                rows :
                    [
                        {template:"<center><h1>All Clients</h1></center>", height: 100},
                        {
                          cols:[
                              {
                                  maxWidth:300,
                                  rows:[
                                      { template: "Link 1"},
                                      { template: "Link 2"},
                                      { template: "Link 3"},

                                  ],

                              },
                              {view:"resizer"},

                              {
                                  view: "form",
                                  maxWidth:400,
                                  id:"data_form",
                                  elements: [
                                      { view:"text", name:"client_name", id:"inp_clientname", placeholder: "Client Name" },// input
                                      { view: "text", id:"email", name:"email",  placeholder:"Email"},
                                      { view: "text", id:"telephone", name:"telephone",  placeholder:"Telephone"},
                                      { view:"datepicker", timepicker: true, id:"created_on", name:"created_on",placeholder:"Created On"},
                                      { view:"textarea", type:"text", name:"address", id:"inp_address", placeholder: "Address" },
                                      {
                                          rows: [

                                              {

                                                  cols:[
                                                      { view:"button", id:"save", autowidth:true, value:"Add new", click:saveData},
                                                      { view:"button", id:"delete", autowidth:true, value:"Delete", click:deleteData},
                                                      { view:"button", id:"update", autowidth:true, value:"Update", click:updateData},
                                                      { view:"button", id:"btn_clear", autowidth:true, value:"Clear", click:clearForm},
                                                  ]
                                              },
                                          ]
                                      },

                                      {},
                                  ]

                              },
                              {
                                  view:"datatable",
                                  id:"clients",
                                  select: true,
                                  on:{
                                      onAfterSelect:valueToForm,  // it gets the id
                                  },
                                  columns:[
                                      {},
                                      {
                                          id:"client_name",
                                          header: "Client Name",
                                          fillspace:true,

                                      },
                                      {
                                          id:"address", fillspace:true,
                                          header:"Address"
                                      },
                                      {
                                          id:"email",
                                          header:"Emails",fillspace:true,
                                      },
                                      {
                                          id:"created_on", fillspace:true,
                                          header:"created date"

                                      },
                                      {
                                          id:"telephone", fillspace:true,
                                          header:"Telephone"

                                      },
                                      {},

                                  ],
                                  data:clients_info,

                              },

                          ]
                        },
                        {},
                    ]


            });
        });
        function  saveData(){
            webix.message("You press the save button");
            // var inp_clientname = $$("inp_clientname").getValue();
            // var inp_address = $$("inp_address").getValue();
            // var email = $$("email").getValue();
            // var created_on = $$("created_on").getValue();
            //
            // webix.ajax().post('action.php', { inp_clientname : inp_clientname, inp_address : inp_address,  email : email, created_on : created_on, action:'insert'}).then(function(data){
            //     // response
            //     webix.message(data.text());
            //     // console.log(data.text());
            //     // $$('result').text(data);
            //     $$("clients").clearAll();
            //     $$("clients").load();
            //     $$("data_form").clear();
            // });

            // $$("accounts").add(item_data);
            // $$("data_form").clear();

        }
        function  deleteData(){
            webix.message("You press the delete button");
            // var list = $$("accounts");
            // var item_id = list.getSelectedId();
            // var item_id = item_id.id
            // // webix.message(item_id.id); //id
            // if(item_id){
            //     webix.confirm("Delete selected list?").then(function(){
            //         webix.ajax().post('action.php', {item_id:item_id }).then(function(data){
            //             webix.message(data.text());
            //
            //             $$("accounts").clearAll();
            //             $$("accounts").load('fetch.php');
            //
            //         });
            //         // list.remove(item_id);
            //     });
            //
            // }else{
            //     webix.message("Please, click any list item")
            // }
        }
        function  updateData(){
            webix.message("You press the Update button");
            // var inp_clientname = $$("inp_clientname").getValue();
            // var inp_address = $$("inp_address").getValue();
            //
            // var email = $$("email").getValue();
            // var created_on = $$("created_on").getValue();
            //
            // // check if it has id then update if not then add
            // var form = $$("data_form");
            // var item_data = form.getValues();
            // var item_data_id = item_data.id;
            // if(item_data.id){
            //     //update
            //     webix.ajax().post('../../helpers/action.php', {item_data_id : item_data_id, inp_clientname : inp_clientname, inp_address : inp_address,  email : email, created_on : created_on, action:'update'}).then(function(data){
            //         // response
            //         webix.message(data.text());
            //         // console.log(data.text());
            //         // $$('result').text(data);
            //         $$("clients").clearAll();
            //         $$("clients").load();
            //         $$("data_form").clear();
            //     });
            // }else{
            //     webix.message("Please, click any list item")
            // }
        }
        function  clearForm(){
            webix.message("You press the clear button");
            $$("data_form").clear();

        }
        function  valueToForm(id){  // the id is used here from the onafterselect
            var values = $$("clients").getItem(id);
            // webix.message(values.id);
            // $$("fname").setValue("Adam Smith"); //setvalue to a specific input
            $$("data_form").setValues(values);



        }
    </script>
</div>
