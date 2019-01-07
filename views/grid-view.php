 <div id="faGrid"></div>



<script type="text/javascript">

$("#faGrid").jsGrid({
    // height: "400px",
    width: "100%",
    autoload: true,
    //inserting: true,
    editing: true,
    sorting: true,
    rowClass: function(item, itemIndex) {
        return "client-" + item.id;
    },
    rowClick: function(args) {
        var $row = $(args.event.target).closest("tr");
        if (this._editingRow) {
            this.updateItem().done($.proxy(function() {
                this.editing && this.editItem($row);
            }, this));
            return;
        }
        this.editing && this.editItem($row);
    },
    controller: {
        loadData: function(item) {
            return $.ajax({
                type: "GET",
                url: "<?=$ctrlurls['dataUrl'];?>",
                data: item
            });
        },
        insertItem: function(item) {
            return $.ajax({
                type: "POST",
                url: "<?=$ctrlurls['dataUrl'];?>",
                data: item
            });
        },
        updateItem: function(item) {
            return $.ajax({
                type: "POST",
                url: "<?=$ctrlurls['updateUrl'];?>",
                data: item
            });
        },
        deleteItem: function(item) {
            return $.ajax({
                type: "GET",
                url: "<?=$ctrlurls['deletUrl'];?>",
                data: item
            });
        },
    },
    fields: [{
            type: "control",
            width: 65,
            editButton: false,
            itemTemplate: function(value, item) {
                var $result = jsGrid.fields.control.prototype.itemTemplate.apply(this, arguments);
                var $customEditButton = $("<a style='font-size:16px;color:blue;margin-left:3px;float:left;text-decoration:none'>")
                    .html('<i class="fa fa-bars" style="margin-right:3px;color:#333;cursor:move"></i> <i class="fa fa-edit" style="margin-right:3px;"></i>')
                    .click(function(e) {
                        window.location.href = "<?=$ctrlurls['editPageUrl'];?>?id=" + item.id;
                        e.stopPropagation();
                    });
                return $result.add($customEditButton);
            }
        },

        <?=$fields;?>
    ],

});


    </script>