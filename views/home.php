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
        <ul></ul>
    
        <button class="add_tab">+</button>
    </nav>
    <section> 
        <div class="messages">
            <div class="message">
                <div class="m_info">
                    <span class="m_sender">André</span>
                    <span class="m_date">10:00</span>
                </div>

                <div class="m_body">
                    O santos é o melhor time do mundo... 
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="sender_area">
            <input type="file" name="sender_input_file" id="sender_input_file">
            <input type="text" name="sender_input" autofocus id="sender_input" placeholder="Digite aqui sua mensagem">
            <div class="sender_tools">
                <div class="sender_tool uploadFilesBtn"></div>
                <div class="sender_tool"></div>
            </div>
        </div>
    </footer>

    <div class="progress">
        <div class="progressbar" style="width: 0%">

        </div>
    </div>
</div>