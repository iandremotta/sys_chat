<div class="container">
    <!-- informações do usuário -->
    <div class="userinfo">
        Logado como:
        <strong><?php echo ucfirst($name); ?> </strong>
        <a href="<?php BASE_URL; ?>settings" class="submenu">
            <img src="<?php echo BASE_URL; ?>assets/images/multimedia.png" alt="Configurações" title="Configurações" width="14" height="12" alt="Configurações">

        </a>

        <a href="<?php echo BASE_URL; ?>login/logout"> Logout</a>
    </div>
    <!-- fim das informações do usuário -->
    <!-- lista de amigos -->
    <div class="friend">
        Lista de amigos
        <ul class="friend-list">
            <li>Amigo 1</li>
            <li>Amigo 2</li>
            <li>Amigo 3</li>
        </ul>
    </div>
    <!-- fim da lista de amigos -->
    <!-- nav para os grupos -->
    <nav>
        <ul>
            <!--Lista dos grupos-->
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <button class="add_tab">+</button>
    </nav>
    <!-- fim da lista dos grupos -->
    <!-- barra de progresso envio de arquivo -->
    <div class="progress">
        <div class="progressbar" style="width: 0%;">

        </div>
    </div>
    <!-- fim da barra de progresso do envio de arquivo  -->
    <section>
        <!-- inicio das mensagens -->
        <div class="messages">
            <div class="message">
                <div class=" m_info">
                    <span class="m_sender">André Motta</span>
                    <span class="m_date">10:00</span>
                </div>
                <div class="m_body">
                    Regras gerais do site:
                    <ul>
                        <li>Trate todos com respeito.</li>
                        <li>Não é permitido nenhum tipo de conteúdo inapropriado.</li>
                        <li>Proibido o uso de palavras de baixo calão no chat.</li>
                        <li>Não fazer divulgação de outras comunidades e até mesmo posts no grupo.</li>
                        <li>Não brigar.</li>
                        <li>Divulgação em geral (Spam)</li>
                        <li>Imagens de cunho inapropriado</li>
                    </ul>
                    <h2>Para entrar em uma sala clique no + no canto superior direito.</h2>
                    <h3>=)</h3>
                </div>
            </div>
        </div>
        <!-- fim das mensagens -->

        <!-- inicio da lista de usuarios -->
        <div class="user_list">
            <ul>
                <li>André <small>online</small></li>
                <li>Pedro <small>online</small></li>
                <li>Erika <small>online</small></li>
                <li>Viviane <small>online</small></li>
                <li>Lobo <small>online</small></li>
            </ul>
        </div>
        <!-- fim da lista de usuarios -->
    </section>
    <!-- envio de texto -->
    <footer>
        <div class="sender_area">

            <input type="file" id="sender_input_img" />
            <input type="text" id="sender_input" placeholder="Digite aqui sua mensagem" autocomplete="off" autofocus />
            <div class="sender_tools">
                <div class="sender_tool imgUploadBtn"></div>
                <div class="sender_tool"></div>
            </div>
        </div>
    </footer>
    <!-- fim do envio de texto -->

</div>