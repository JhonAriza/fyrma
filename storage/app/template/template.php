<style type="text/css">
    <!--
    table {
        vertical-align: middle;
    }

    tr {
        vertical-align: middle;
    }

    td {
        vertical-align: middle;
    }

    .header {
        padding: 20px;
    }

    .externalBorder {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 5px;
    }

    .panelesTitulos {
        border-radius: 5px 5px 0px 0px;
        border: 1px solid #ddd;
        background-color: #f5f5f5;
        padding: 5px;
    }

    .panelesInfo {
        border-radius: 0px 0px 5px 5px;
        border: 1px solid #ddd;
        border-top: 0px !important;
        padding: 5px;
    }

    .panelFacturaAfectada {
        border-radius: 0px 0px 5px 5px;
        border: 1px solid #ddd;
        padding: 5px;
    }

    .productosTitulos {
        border-radius: 0px 0px 0px 0px;
        border: 1px solid #ddd;
        background-color: #f5f5f5;
        padding: 5px;
    }

    .productosInfo {
        padding: 5px;
        border-bottom: 1px solid #ddd;
        vertical-align: middle;
    }

    .noBottomRadius {
        border-radius: 8px 8px 0px 0px;
        border: 1px solid #ddd;
        vertical-align: middle;
        height: 20px;
    }

    table.page_footer {
        width: 100%;
        padding: 2mm;
        padding-left: 5mm;
        border: none;

    }

    .grid-cols-2 {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .grid {
        display: grid;
    }

    div {
        display: block;
    }
    -->
</style>
<page backcolor="#FEFEFE" backtop="10mm" backbottom="40mm" backleft="25mm" backright="25mm" style="font-size: 10px;font-family: arial">
    <page_footer>
        <table cellspacing="0" style="width: 100%; text-align: center;font-size: 10px" class="page_footer">
            <tr>
                <td style="width: 50%; text-align: left">
                    <?php if (isset($this->data->signImage)) { ?>
                        <img style="width: 40mm;" class="img img-responsive" align="middle" src="<?php echo $this->data->signImage ?>" alt="Logo">
                    <?php } ?>
                </td>
                <td style="width: 50%; text-align: left; vertical-align: bottom;">
                </td>
            </tr>
        </table>
        <table cellspacing="0" style="width: 100%; text-align: center;font-size: 10px" class="page_footer">
            <tr>
                <td style="width: 20%; text-align: left">
                    Página [[page_cu]]/[[page_nb]]
                </td>
                <td style="width: 60%;; text-align: center">
                </td>
                <td style="width: 20%; text-align: right">
                </td>
            </tr>
        </table>
    </page_footer>
    <bookmark title="Lettre" level="0">
        <?php echo $this->html; ?>
    </bookmark>
</page>