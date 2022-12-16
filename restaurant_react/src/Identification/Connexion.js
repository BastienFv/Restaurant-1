import Menu from '../Components/Menu';
import '../Styles/Connexion.css';
import Footer from '../Components/Footer';
import header_img from '../Images/header_login.png';
import '../Styles/Home.css';
import { useState } from 'react';
//import { Navigate } from "react-router-dom";

function Connexion() {
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");

    function submit(e) {
        e.preventDefault();
        connect();
    }

    async function connect() {
        const options = {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                email: email,
                password: password
            })
        };

        const response = await fetch(`http://127.0.0.1:8000/api/restaurateurs/login`, options);
        const data = await response.json();
        console.log("Data : ", data);
        const token = data.token;
        const id = data.id;
        const message = data.message;

        if (message === 'Connexion réussi.') {

            console.log("Token : ", token);
            console.log("ID : ", id);

            localStorage.setItem("token", JSON.stringify(token));
            localStorage.setItem("ID", JSON.stringify(id));

            alert("Vous êtes connecté");

            return window.location.href = '/produits';
        }

        if (message !== 'Connexion réussi.') {
            alert("Veuillez remplir tous les champs de connexion.");
        }
    }

    return (
        <div>
            <Menu />
            <div className='connexion_position'>
                <div className="connexionPositionBis">

                    <div className='connexion_title'>
                        <span>
                            Connectez-vous pour <br /><span id="home_title_color">accéder</span> à votre compte
                        </span>
                    </div>


                <div className="login">
                    <form method="POST" action="" id="form" onSubmit={submit}>
                        <div className="textbox">
                            <label htmlFor="email"></label>
                            <input type="email" id="email" name="email" value={email} onChange={(e) => setEmail(e.target.value)} placeholder="email" required />
                            <span className="material-symbols-outlined"> 
                                email 
                            </span>
                        </div>

                            <div className="textbox connexion">
                                <label htmlFor="password"></label>
                                <input type="password" id="password" name="password" value={password} onChange={(e) => setPassword(e.target.value)} placeholder="password" required />
                                <span className="material-symbols-outlined">
                                    key
                                </span>
                            </div>

                            <p>
                                <a href="/Maj">Mot de passe oublié ?</a>
                            </p>

                            <button type="submit" id="submitLog" value="Login">
                                Connexion
                                <span className="material-symbols-outlined"> arrow_forward </span>
                            </button>
                            <p>
                                Vous n'avez pas de compte ?
                                <a href="/inscription"> Inscrivez-vous</a>
                            </p>
                        </form>
                    </div>
                </div>
                <img src={header_img} alt="header_img" className="imageLogin" />

            </div>
            <Footer />
        </div>
    );
}

export default Connexion;