<div class="container">
    <div class="userinfo" >
            Logado como: 
                <strong><?php echo ucfirst($name);?> </strong> 
                <a href="<?php BASE_URL;?>settings" class="submenu"> 
                    <img src="<?php echo BASE_URL;?>assets/images/multimedia.png" alt="Configurações" title="Configurações"  width="14" height="12" alt="Configurações">
                    
                </a>
                   
            <a href="<?php echo BASE_URL; ?>login/logout"> Logout</a>
    </div>

    <div class="friend">
        Lista de amigos
        <ul class="friend-list">
            <li>Amigo 1</li>
            <li>Amigo 2</li>
            <li>Amigo 3</li>
        </ul>
    </div>
    
    <nav>
        <ul>

        </ul>
    
        <button class="add_tab">+</button>
    </nav>

    <div class="progress">
        <div class="progressbar" style="width: 0%;">
    
        </div>
    </div>
    <section> 
        <div class="messages"></div>
    </section>

    <footer>
        <div class="sender_area">
            
			<input type="file" id="sender_input_img" />
			<input type="text" id="sender_input" placeholder="Digite aqui sua mensagem" />
			<div class="sender_tools">
				<div class="sender_tool imgUploadBtn"></div>
				<div class="sender_tool"></div>
			</div>
		</div>
    </footer>

  
</div>