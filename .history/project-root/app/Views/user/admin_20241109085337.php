<div class="container-fluid admin-fluid">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-10">
            <div class="container">
               <div class="sidebar">
                  <div class="card">
                     <p>👤</p>
                     <p><?=count($users)?></p>
                     <p>Regisztrált felhasználók</p>
                  </div>
                  <div class="card">
                     <p>📝</p>
                     <p><?=count($medias)?></p>
                     <p>Hozzáadott filmek</p>
                  </div>
                  <div class="form-card">
                     <h3>Admin hozzáadása</h3>
                     <form>
                        <label for="admin-email">Admin email:</label>
                        <input type="email" id="admin-email" placeholder="Admin email">
                        <label for="admin-password">Admin jelszó:</label>
                        <input type="password" id="admin-password" placeholder="Admin jelszó">
                        <button type="submit">Létrehozás</button>
                     </form>
                  </div>
                  <div class="form-card">
                     <h3>Film hozzáadása</h3>
                     <form action="<?=base_url('admin/createMedia')?>" method="POST">
                        <label for="film-title">Film címe:</label>
                        <input type="text" id="film-title" name="film_title" placeholder="Film címe">
                        <label for="film-url">Film URL:</label>
                        <input type="text" id="film-url" name="film_url" placeholder="Film URL">
                        <label for="film_released">Film megjelenési dátum:</label>
                        <input type="text" id="film_released" name="film_released" placeholder="Film Dátum">
                        <label for="film-description">Film leírása:</label>
                        <textarea id="film-description" name="film_desc" placeholder="Film leírása"></textarea>
                        <label for="film-image">Film kép feltöltése:</label>
                        <input type="file" id="film-image" name="film_img" accept="image/*">
                        <button type="submit">Létrehozás</button>
                     </form>
                  </div>
               </div>
               <div class="content">
                  <div class="table users">
                     <h3>Felhasználók</h3>
                     <table>
                        <thead>
                           <tr>
                              <th>Név:</th>
                              <th>Email:</th>
                              <th>Szerepkör:</th>
                              <th>Regisztrálási dátum:</th>
                              <th>Művelet:</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php foreach($users as $item):?>
                              <tr>
                                 <td><?=$item['Username']?></td>
                                 <td><a href="mailto:Teszt1@aol.com"><?=$item['Email']?></a></td>
                                 <?php if($item['Is_admin']):?>
                                    <td>Admin</td>
                                 <?php else:?>
                                    <td>Felhasználó</td>
                                 <?php endif;?>
                                 <td><?=$item['Created']?></td>
                                 <td><button type="button" class="btn btn-danger" data-id="<?=$item['ID']?>">Törlés</button></td>
                              </tr>
                           <?php endforeach;?>
                        </tbody>
                     </table>
                  </div>
                  <div class="table films">
                     <h3>Filmek</h3>
                     <table>
                        <thead>
                           <tr>
                              <th>Név:</th>
                              <th>URL:</th>
                              <th>Művelet:</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php foreach($medias as $item):?>
                              <tr>
                                 <td><?=$item['Title']?></td>
                                 <td>URL</td>
                                 <td><button type="button" class="btn btn-danger" data-id="<?=$item['ID']?>">Törlés</button></td>
                              </tr>
                           <?php endforeach;?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
