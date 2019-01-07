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
                        window.location.href = "<?=Yii::getAlias('@web');?>/admin/item/update?id=" + item.id;
                        e.stopPropagation();
                    });
                return $result.add($customEditButton);
            }
        }, {
            name: "id",
            title: "ItemId",
            width: 50
        }, {
            name: "number",
            type: "text",
            title: "Number",
            width: 50
        }, {
            name: "name",
            type: "text",
            title: "Name",
            width: 180,
        }, {
            name: "description",
            type: "textarea",
            title: "Description",
            width: 210,
        }, {
            name: "price",
            type: "text",
            title: "Price",
            width: 75,
        },
        //  { name: "order", type: "number",title:"Order", width: 150 },
        {
            name: "indent",
            type: "number",
            title: "Indent",
            width: 50,
        }, {
            name: "image",
            itemTemplate: function(val, item) {
                var ht = "";
                ht += "<a href='javascript:void(0)' onclick='getImagePopup(" + item.id + ")' style='text-decoration:none'> ";
                if (val != null) {
                    ht += "<img src='<?=$image_path;?>" + item.id + "/" + val + "' class='cell-image'>";
                }
                ht += " (" + item.image_count + ")</a>";
                return ht;
            },
            width: 60,
        }, {
            name: "type",
            type: "select",
            items: type,
            title: "Type",
            width: 60,
            valueField: "Id",
            textField: "Name"
        }, {
            name: "parent_id",
            type: "select",
            items: parents,
            title: "Parent",
            valueField: "id",
            textField: "name",
        }, {
            name: "is_deleted",
            type: "checkbox",
            title: "Deleted",
            width: 60,
        }, {
            name: "is_hidden",
            type: "checkbox",
            title: "Hidden",
            width: 60,
        }, {
            name: "page",
            type: "select",
            items: pages,
            title: "Page",
            valueField: "id",
            textField: "name"
        },
    ],
    onRefreshed: function() {
        var $gridData = $("#jsGrid .jsgrid-grid-body tbody");
        $gridData.sortable({
            update: function(e, ui) {
                // array of indexes
                var clientIndexRegExp = /\s*client-(\d+)\s*/;
                var indexes = $.map($gridData.sortable("toArray", {
                    attribute: "class"
                }), function(classes) {
                    return clientIndexRegExp.exec(classes)[1];
                });
                $.ajax({
                    method: "post",
                    data: {
                        indexes
                    },
                    url: "<?=Yii::getAlias('@web');?>/admin/item/update-order",
                    success: function(data) {
                        console.log("success");
                    }
                });
                // arrays of items
                var items = $.map($gridData.find("tr"), function(row) {
                    $(row).data("JSGridItem");
                });
                console.log(indexes);
                console && console.log("Reordered items", items);
            }
        });
    }
});


    </script>