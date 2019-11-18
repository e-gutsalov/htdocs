<?php

spl_autoload_register();

class model
{
    private
        $date,
        $text_field,
        $read_GET,
        $unread_GET,
        $text,
        $att,
        $line,
        $db,
        $query;

    public function __construct($read_GET, $unread_GET)
    {
        $this->read_GET = $read_GET;
        $this->unread_GET = $unread_GET;
    }

    public function getDate()
    {
        return $this->date = date('c');
    }

    public function connectBase()
    {
        try
        {
            $this->db = new PDO('mysql:host=localhost;dbname=cosmos', 'root', 'metallica');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $exception)
        {
            echo 'Подключение не удалось: ' . $exception->getMessage();
        }
            return $this->db;
    }

    public function getFile()
    {
        $this->db = $this->connectBase();
        $this->query = "SELECT * FROM `message`";
        if ($this->text_field = $this->db->query($this->query))
        {
            while ($this->text = $this->text_field->fetchObject())
            {
                $this->att = $this->text->id;
                $this->line = $this->text->message;
                $this->getMess();
                if ($this->text->status == 1) {
                ?>
                <script> document.getElementById("app<?=$this->att?>").className = "success" </script>
                <?php
                }
            }
            $this->db = null;
        }
    }

    public function getMess()
    {
?>
        <tr id="app<?=$this->att?>" v-bind:class="styleCSS">
            <td><?=$this->getDate()?></td>
            <td><?=$this->line?></td>
            <td>
                <form action="index.php" method="GET">
                    <input type="hidden" name="mark_read" value="<?=$this->att?>">
                    <input v-on:click="styleCSS='success'" type="submit" class="btn btn-primary" value="Прочитать">
                </form>
            </td>
            <td>
                <form action="index.php" method="GET">
                    <input type="hidden" name="mark_unread" value="<?=$this->att?>">
                    <input type="submit" class="btn btn-primary" value="Не прочитанно">
                </form>
            </td>
        </tr>
        <script>
            let app<?=$this->att?> = new Vue({
                el: '#app<?=$this->att?>',
                data: {
                    message: '',
                    styleCSS: ''
                },
                methods: {

                }
            });
        </script>
<?php
    }

    public function getRead()
    {
        if (!empty($this->read_GET))
        {
            $this->db = $this->connectBase();
            $this->query = "UPDATE `message` SET `status` = 1 WHERE `id` = $this->read_GET";
            $this->db->query($this->query);
        }
    }

    public function unRead()
    {
        if (!empty($this->unread_GET))
        {
            $this->db = $this->connectBase();
            $this->query = "UPDATE `message` SET `status` = 0 WHERE `id` = $this->unread_GET";
            $this->db->query($this->query);
        }
    }
}
?>