import logo from '../Images/logo.png';
import '../Styles/Menu.css';
import { useState, useEffect } from 'react';

function Menu() {
    const [isOpen, setIsOpen] = useState(false);

    useEffect(() => {
        console.log("isopen", isOpen)
    }, [isOpen]
    );

    return (
        <div>
            <div className="navbar_logo">
                <img src={logo} alt='logo' />
            </div>
            <nav className="navbar">
                <a href="/">HOME </a>

                <a href="/creation/restaurant">AJOUTER UN RESTAURANT </a>

                <a href="/produits">PRODUIT </a>

                <a href="/cartes">Cartes </a>

                <span id="navbar_style">
                    <a href="/connexion">CONNEXION </a>
                </span>

                <span id="navbar_style">
                    <a href="/inscription">INSCRIPTION </a>
                </span>

            </nav>
        </div>
    )
}

export default Menu;
