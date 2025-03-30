<div class="col" style="border: 1px solid #ccc; border-radius: 10px; padding: 10px; margin: 10px;">
                <img src="image/post_property_image/<?=htmlspecialchars($property_data['post_images'])?>" class="card-img-top" alt="Property Image" style="width: 100%; height: 400px; border-radius: 10px;">
                <div class="row">
                    <div class="col-md-12 ms-2 mt-3">
                        <i class="bi bi-heart-fill" style="color: red;"></i>
                        <span style="font-size: 18px; font-weight: bold;"><?=htmlspecialchars($likes)?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 ms-2 mt-3">
                        <i class="bi bi-star-fill" style="color: yellow;"></i>
                        <span style="font-size: 18px; font-weight: bold;"><?=htmlspecialchars($favorite)?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 ms-2 mt-3">
                        <button class='btn btn-danger' id='delete'> remove post </button>
                    </div>
                </div>
            </div>

            <div class="col border mt-2" style="padding: 10px; border-radius: 10px;">
                <h2 class='text-center' style="font-size: 24px; font-weight: bold; color: #333;"> Rent Request </h2>
                <?php foreach ($request as $req): ?>
                    <button class="req alert alert-success m-0 p-2" value='<?=htmlspecialchars($req['apply_id'])?>' style='width:100%; border-radius: 5px; font-size: 16px; font-weight: bold;'>Request from <?=htmlspecialchars($req['tenant_fullname'])?></button>
                <?php endforeach; ?>               
            </div>