<!--    --><?php //foreach($data['clients'] as $client): ?>
<!--        <div class="container-item">-->
<!--            --><?php //if(isset($_SESSION['user_id']) ): ?>
<!---->
<!--                <a-->
<!--                        class="btn orange"-->
<!--                        href="--><?php //echo URLROOT . "/clients/update/" . $client->id ?><!--">-->
<!--                    Update-->
<!--                </a>-->
<!--                <form action="--><?php //echo URLROOT . "/clients/delete/" . $client->id ?><!--" method="POST">-->
<!--                    <input type="submit" name="delete" value="Delete" class="btn red">-->
<!--                </form>-->
<!--            --><?php //endif; ?>
<!--            <h2>-->
<!--                --><?php //echo $client->client_name; ?>
<!--            </h2>-->
<!---->
<!--            <h3>-->
<!--                --><?php //echo 'Created on: ' . date('F j h:m', strtotime($client->created_on)) ?>
<!--            </h3>-->
<!---->
<!--            <p>-->
<!--                --><?php //echo $client->address ?>
<!--            </p>-->
<!--        </div>-->
<!--    --><?php //endforeach; ?>

[{"id":1,"client_name":"Daniel","address":"Kursk","email":"mon@yahoo.com","created_on":"2021-02-12 13:53:51","telephone":"1273633"},
{"id":2,"client_name":"Maxwell","address":"new delhi and kursk junction","email":"max@yahoo.com","created_on":"2021-02-12 00:00:00","telephone":"82778181222"}]";
