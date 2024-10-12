<template>
  <transition name="modal-fade" >
    <div v-if="open && !cookieEssencialAceito" class="cookie-compliance-modal">
      <div class="transparent-bg" v-if="showSettings" @click.prevent="showSettings = false"></div>
      <div class="cc-modal">
        <div class="cc-modal-content">
          <h3 class="cc-modal-title">Preferências de Privacidade</h3>
          <div class="cc-modal-text">
            Nós utilizamos cookies essenciais em nosso site.
            <!-- Nós utilizamos cookies em nosso site. Alguns cookies são essenciais,
            outros nos ajudam a melhorar continuamente o site. -->
          </div>
        </div>
        <div class="cc-modal-footer">
          <div class="cc-modal-button-group">
            <a
              class="cc-button cc-button-primary"
              @click.prevent="accept('all')"
              >Aceitar e continuar</a
            >
            <!-- <a class="cc-button" @click.prevent="accept('essential')"
              >Aceitar somente os essenciais</a
            > -->
          </div>

          <div class="cc-modal-links">
            <router-link to="/politica-privacidade">
              Políticas de privacidade
            </router-link>
            <a @click.prevent="showSettings = !showSettings" data-cc-toggle
              >Configurações de cookies</a
            >
          </div>
          <transition name="fade">
            <div v-if="showSettings" class="cc-modal-settings">
              <div class="cookie-settings essential">
                <div class="cookie-settings-header">
                  <h3>Essenciais</h3>
                  <toggle-switch :checked="true" :disabled="true" />
                </div>
                <div class="cookie-settings-body">
                  <p>
                    Estes cookies são necessários para que o website funcione,
                    por isso não podem ser desativados. Normalmente, eles só são
                    atribuídos em resposta a ações suas de solicitação de
                    serviços, tais como definir as suas preferências de
                    privacidade, iniciar sessão ou preencher formulários. Você
                    pode configurar o seu navegador para bloquear ou
                    alertá-lo(a) sobre esses cookies, mas algumas partes do
                    website não funcionarão. Estes cookies não armazenam
                    qualquer informação pessoal identificável.
                  </p>
                  <!-- <div class="cookie-settings-content">
                      <div class="cookie-item">
                        <h4>Security</h4>
                        <p>Cookie set by the website owner to prevent cross-site request forgery (CSRF) attacks.</p>
  
                        <dl>
                          <dt>Provider</dt>
                          <dd>Provider of this website</dd>
                          <dt>Cookie name</dt>
                          <dd>XSRF-TOKEN</dd>
                          <dt>Cookie expiry</dt>
                          <dd>1 hour</dd>
                        </dl>
                      </div>
  
                      <div class="cookie-item">
                        <h4>Session</h4>
                        <p>Cookie set by the website owner to identify the browser session.</p>
  
                        <dl>
                          <dt>Provider</dt>
                          <dd>Provider of this website</dd>
                          <dt>Cookie name</dt>
                          <dd>laravel_session</dd>
                          <dt>Cookie expiry</dt>
                          <dd>1 hour</dd>
                        </dl>
                      </div>
  
                      <div class="cookie-item">
                        <h4>Preferences</h4>
                        <p>Cookie set by the website owner to save the cookie preferences of the visitor.</p>
  
                        <dl>
                          <dt>Provider</dt>
                          <dd>Provider of this website</dd>
                          <dt>Cookie name</dt>
                          <dd>laravel_cc_settings</dd>
                          <dt>Cookie expiry</dt>
                          <dd>1 month</dd>
                        </dl>
                      </div>
                    </div> -->
                </div>
              </div>

              <!-- DESEMPENHO -->
              <!-- <div class="cookie-settings tracking">
                <div class="cookie-settings-header">
                  <h3>Cookies de desempenho</h3>
                  <toggle-switch :checked="true" />
                </div>
                <div class="cookie-settings-body">
                  <p>
                    Os cookies de desempenho possibilitam a análise de
                    desempenho do site, através de contagem de visitas e fontes
                    de tráfego. Podemos avaliar quais foram as páginas mais e
                    menos visitadas e como os usuários navegam pelo website.
                    Toda a informação que estes cookies recolhem são agregadas
                    e, portanto, anônimas. Se você optar por desativar estes
                    cookies, não saberemos quando visitou o nosso website e não
                    poderemos monitorar o seu desempenho.
                  </p>

                  <div class="cookie-settings-content">
                      <div class="cookie-item">
                        <h4>Google Analytics</h4>
                        <p>
                          Cookies set by Google for website analytics. Generates anonymized statistical data on how the visitor
                          uses the website.
                        </p>
  
                        <dl>
                          <dt>Provider</dt>
                          <dd>Google LLC</dd>
                          <dt>Cookie name</dt>
                          <dd>_ga, _gat, _gid</dd>
                          <dt>Cookie expiry</dt>
                          <dd>2 years</dd>
                          <dt>Privacy policy</dt>
                          <dd>
                            <a
                              href="https://policies.google.com/privacy?hl=en"
                            >policies.google.com/privacy</a>
                          </dd>
                        </dl>
                      </div>
                    </div>
                </div>
              </div> -->

              <!-- FUNCIONALIDADES -->
              <!-- <div class="cookie-settings functionality">
                <div class="cookie-settings-header">
                  <h3>Cookies de funcionalidades</h3>
                  <toggle-switch :checked="true" />
                </div>
                <div class="cookie-settings-body">
                  <p>
                    Estes cookies permitem que ofereçamos funcionalidades e
                    personalização melhoradas, tais como plugins de exibição de
                    conteúdos dos blogs, de redes sociais e de opções de
                    compartilhamento de páginas. Podem ser estabelecidos por nós
                    ou por fornecedores externos cujos serviços adicionamos às
                    nossas páginas. Se você optar por não consentir esta
                    autorização, algumas funcionalidades do site deixarão de
                    funcionar ou não funcionarão corretamente.
                  </p>

                  <div class="cookie-settings-content">
                      <div class="cookie-item">
                        <h4>Google Analytics</h4>
                        <p>
                          Cookies set by Google for website analytics. Generates anonymized statistical data on how the visitor
                          uses the website.
                        </p>
  
                        <dl>
                          <dt>Provider</dt>
                          <dd>Google LLC</dd>
                          <dt>Cookie name</dt>
                          <dd>_ga, _gat, _gid</dd>
                          <dt>Cookie expiry</dt>
                          <dd>2 years</dd>
                          <dt>Privacy policy</dt>
                          <dd>
                            <a
                              href="https://policies.google.com/privacy?hl=en"
                            >policies.google.com/privacy</a>
                          </dd>
                        </dl>
                      </div>
                    </div>
                </div>
              </div> -->

              <!-- FUNCIONALIDADES -->
              <!-- <div class="cookie-settings functionality">
                <div class="cookie-settings-header">
                  <h3>Cookies de publicidade</h3>
                  <toggle-switch :checked="true" />
                </div>
                <div class="cookie-settings-body">
                  <p>
                    Estes cookies podem ser ativados pelos nossos websites ou
                    pelos nossos parceiros de publicidade. Não armazenam
                    diretamente informações pessoais, mas são baseados nos dados
                    relativos à sua navegação, pra apresentar anúncios
                    personalizados no ambiente digital e podem lhe ajudar a
                    conhecer produtos ou promoções do seu interesse. Se não
                    permitir estes cookies, terá menos publicidade direcionada.
                  </p>

                  <div class="cookie-settings-content">
                      <div class="cookie-item">
                        <h4>Google Analytics</h4>
                        <p>
                          Cookies set by Google for website analytics. Generates anonymized statistical data on how the visitor
                          uses the website.
                        </p>
  
                        <dl>
                          <dt>Provider</dt>
                          <dd>Google LLC</dd>
                          <dt>Cookie name</dt>
                          <dd>_ga, _gat, _gid</dd>
                          <dt>Cookie expiry</dt>
                          <dd>2 years</dd>
                          <dt>Privacy policy</dt>
                          <dd>
                            <a
                              href="https://policies.google.com/privacy?hl=en"
                            >policies.google.com/privacy</a>
                          </dd>
                        </dl>
                      </div>
                    </div>
                </div>
              </div> -->
            </div>
          </transition>
        </div>
      </div>
    </div>
  </transition>
</template>
  
  <script>
import ToggleSwitch from "./ToggleSwitch.vue";
export default {
  name: "CookieComplianceModal",
  components: {
    ToggleSwitch,
  },
  data() {
    return {
      open: true,
      showSettings: false,
      cookieEssencialAceito: false
    };
  },
  beforeMount() {
    this.cookieEssencialAceito = localStorage.getItem('cookies_essenciais');
  },
  methods: {
    accept(type) {
      console.log("type", type);
      this.showSettings = false;

      localStorage.setItem('cookies_essenciais', true);
      setTimeout(() => {
        this.close();
      }, 250);
    },
    close() {
      this.open = false;
    },
  },
};
</script>
  
  <style lang="css" scoped>
.transparent-bg {
  position: fixed;
  width: 100vw;
  height: 100vh;
  top: 0;
  left: 0;
  background: transparent;
}
.cookie-compliance-modal {
  position: fixed;
  width: fit-content;
  height: fit-content;
  bottom: 15px;
  z-index: 995;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #636b6f;
  font-family: "Nunito", sans-serif;
  font-weight: 200;
  line-height: 1.5;
  width: 100%;
  background: #fff;
  margin: 0 auto;
  padding: 0 15px;
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
    0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.cookie-compliance-modal p {
  color: #676767;
}
.cookie-compliance-modal h4 {
  color: #676767;
}

.cookie-compliance-modal .cc-modal {
  background: #fff;
  border-radius: 0.5rem;
  max-width: 1300px;
  width: 100%;
  position: relative;
  z-index: 10;
  overflow: hidden;
  color: #161e2e;
  max-height: 85vh;
  overflow: auto;
}

.cookie-compliance-modal .cc-modal .cc-modal-content {
  padding: 15px;
}

.cookie-compliance-modal .cc-modal .cc-modal-content .cc-modal-title {
  margin: 0;
  font-size: 1.125rem;
  color: #000;
}

.cookie-compliance-modal .cc-modal .cc-modal-content .cc-modal-text {
  margin-top: 0.5rem;
  color: #676767;
}

.cookie-compliance-modal .cc-modal .cc-modal-footer {
  padding: 0.75rem 1.5rem;
  background-color: #fff;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}

.cookie-compliance-modal .cc-modal .cc-modal-footer .cc-modal-button-group {
  display: flex;
  justify-content: space-between;
  margin-right: 20px;
}

.cookie-compliance-modal
  .cc-modal
  .cc-modal-footer
  .cc-modal-button-group
  .cc-button {
  text-align: center;
  padding: 0.5rem 1rem;
  cursor: pointer;
  background: rgba(107, 114, 128, 0.5);
  border-radius: 0.5rem;
  font-size: 0.875rem;
  line-height: 1.25rem;
  color: #fff;
  margin-right: 10px;
}

.cookie-compliance-modal
  .cc-modal
  .cc-modal-footer
  .cc-modal-button-group
  .cc-button.cc-button-primary {
  background-color: #00a5d3;
}

.cookie-compliance-modal .cc-modal .cc-modal-links {
  display: flex;
  justify-content: flex-end;
  margin-top: 15px;
  font-size: 12px;
}

.cookie-compliance-modal .cc-modal .cc-modal-links a {
  padding: 0 0.35rem;
  display: flex;
  align-items: center;
  color: #3f475c;
  text-decoration: none;
  cursor: pointer;
}

.cookie-compliance-modal .cc-modal .cc-modal-links a:not(:last-child) {
  border-right: 1px solid rgba(107, 114, 128, 0.5);
}

.cookie-compliance-modal a[data-cc-toggle]::after {
  border-style: solid;
  border-width: 0.05em 0.05em 0 0;
  border-color: #000;
  content: "";
  display: inline-block;
  height: 0.45em;
  margin-left: 0.25rem;
  position: relative;
  top: 0;
  transform: rotate(135deg);
  vertical-align: top;
  width: 0.45em;
  transition: all 0.35s;
}

.cookie-compliance-modal a[data-cc-toggle].active::after {
  top: 0.15em;
  transform: rotate(-45deg);
}

.cookie-compliance-modal .cc-modal-settings {
  border-top: 1px solid rgba(107, 114, 128, 0.15);
  overflow: hidden;
  padding: 25px 0;
  margin-top: 30px;
}

.cookie-compliance-modal h3 {
  margin: 0;
  color: #000;
}

.cookie-compliance-modal h4 {
  margin: 1rem 0 0.5rem;
  font-size: 18px;
  text-align: left;
  color: #000;
}

.cookie-compliance-modal p {
  font-size: 14px;
  line-height: 1.5;
  margin-top: 0;
  color: #676767;
}

.cookie-compliance-modal dl {
  font-size: 14px;
  margin: 0;
  overflow: hidden;
  opacity: 0.65;
  transition: opacity 0.35s;
  color: #676767;
}

.cookie-compliance-modal dl:hover {
  opacity: 1;
}

.cookie-compliance-modal dl dt {
  float: left;
  width: 30%;
  color: #676767;
}

.cookie-compliance-modal dl dt:after {
  content: ": ";
}

.cookie-compliance-modal dl dd {
  float: left;
  width: 70%;
  margin-left: 0;
  color: #676767;
}

.cookie-compliance-modal dl dd a {
  color: #3f475c;
  border-bottom: 1px solid #9caccf;
  text-decoration: none;
}

.cookie-compliance-modal .cookie-settings:not(:last-child) {
  margin-bottom: 1.5rem;
}

.cookie-compliance-modal .cookie-settings-content {
  margin-top: 1.25rem;
  padding: 0.25rem 1rem 1rem;
  background: rgba(107, 114, 128, 0.05);
}

.cookie-compliance-modal .cookie-settings-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}

.fade-enter-active,
.fade-leave-active {
  transition: all 0.5s;
  max-height: 500vh;
}

.fade-enter,
.fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
  max-height: 0px;
}

.modal-fade-enter-active,
.modal-fade-leave-active {
  transition: all 0.5s;
  transition-delay: 0.25s;
}

.modal-fade-enter,
.modal-fade-leave-to /* .modal-fade-leave-active below version 2.1.8 */ {
  opacity: 0;
  backface-visibility: hidden;
}

.modal-fade-enter .cc-modal,
.modal-fade-leave-to .cc-modal {
  transition: all 0.5s;
  transform-origin: center;
}

.modal-fade-enter .cc-modal {
  transform: scale(0.5);
  filter: blur(3px);
  backface-visibility: hidden;
}
</style>
  