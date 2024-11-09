<div class="container-fluid admin-fluid">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-10">
            <div class="container">
               <div class="sidebar">
                  <div class="card">
                     <p>👤</p>
                     <p>6</p>
                     <p>Regisztrált felhasználók</p>
                  </div>
                  <div class="card">
                     <p>📝</p>
                     <p>5</p>
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
                     <form>
                        <label for="film-title">Film címe:</label>
                        <input type="text" id="film-title" placeholder="Film címe">
                        <label for="film-url">Film URL:</label>
                        <input type="text" id="film-url" placeholder="Film URL">
                        <label for="film-description">Film leírása:</label>
                        <textarea id="film-description" placeholder="Film leírása"></textarea>
                        <label for="film-image">Film kép feltöltése:</label>
                        <input type="file" id="film-image" accept="image/*">
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
                                 <td><a href="#">Törlés</a></td>
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
                           <tr>
                              <td>Film1</td>
                              <td>/Film1</td>
                              <td><a href="#">Törlés</a></td>
                           </tr>
                           <tr>
                              <td>Film2</td>
                              <td>/Film2</td>
                              <td><a href="#">Törlés</a></td>
                           </tr>
                           <tr>
                              <td>Film3</td>
                              <td>/Film3</td>
                              <td><a href="#">Törlés</a></td>
                           </tr>
                           <tr>
                              <td>Film4</td>
                              <td>/Film4</td>
                              <td><a href="#">Törlés</a></td>
                           </tr>
                           <tr>
                              <td>Film5</td>
                              <td>/Film5</td>
                              <td><a href="#">Törlés</a></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
