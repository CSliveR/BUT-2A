/* 
 * File:   Mondial.cpp
 * Author: hb
 * 
 * Created on 22 novembre 2018, 16:05
 */

#include "Mondial.h"


#include <algorithm>
#include <iostream>     // pour cout
#include <iomanip>      // pour setw()
#include <sstream>
#include <iterator>

Mondial::Mondial(const char* filename) {
    // Chargement du fichier XML en mémoire
    imageMondial.LoadFile(filename);
    // Initialisation de l'attribut racineMondial avec la racine (élément <mondial>)
    racineMondial = imageMondial.FirstChildElement();
}


void Mondial::Print() {
    imageMondial.Print();
}

/*
 * FOURNIE
 */
int Mondial::getNbAirports() const {
    // initialisation du nombre d’aéroports
    int nb = 0;
    // accéder à <airportscategory>, c’est un fils de l'élément <racineMondial>
    XMLElement* airportsCategory = racineMondial->FirstChildElement("airportscategory");
    // parcours complet des fils de <airportscategory> en les comptants
    // 1) accéder au premier fils <airport> de <airportscategory>
    XMLElement* currentAirport = airportsCategory->FirstChildElement();
    // 2) parcourir tous les <airport> qui sont des frères
    while (currentAirport != nullptr) {
        // un aéroport supplémentaire
        nb = nb + 1;
        // avancer au frère <airport> suivant de currentAirport
        currentAirport = currentAirport->NextSiblingElement();
    }
    // currentAirport n’a plus de frère {currentAirport == nullptr}, c’est le dernier
    return nb;
}

/*
 * FOURNIE
 */
void Mondial::printCountriesCode() const {
    int rank = 1; // rang du pays
    string carcodeValue; // valeur de l'attribut "car_cod" du pays courant
    // accéder à <countriescategory>, c’est un fils de l'élément <racineMondial>)
    XMLElement* countriesCategory = racineMondial->FirstChildElement("countriescategory");
    // parcours complet des fils de <countriescategory> en affichant le rang et le code
    // 1) accéder au premier fils <country> de <countriescategory>
    XMLElement* currentCountry = countriesCategory->FirstChildElement();
    // 2) parcourir tous les <country> qui sont des frères
    while (currentCountry != nullptr) {
        // traiter le pays courant
        //      1) récupérer la valeur de l’attribut "car_code"
        carcodeValue = currentCountry->Attribute("car_code");
        //      2) faire l’affichage
        cout << setw(5) << rank << " : " << carcodeValue << endl;
        // avancer au frère <country> suivant de currentCountry
        currentCountry = currentCountry->NextSiblingElement();
        // mettre à jour le rang
        rank = rank + 1;
    }
    // currentCountry n’a pas de frère {currentCountry == nullptr}, c’est fini
}


/**
 * Méthode (algorithme itératif) qui compte le nombre de déserts référencés dans mondial_HB.xml
 * @return nbDeserts -> nombre de déserts référencés dans mondial_HB.xml
 */
int Mondial::getNbDeserts() const {
    /*
     * A COMPLETER
     */
 int nbDeserts = 0;
 /*On se place dans la catégorie qui regroupe l'ensemble des déserts du monde*/
 XMLElement *desertCategory = racineMondial->FirstChildElement("desertscategory");
 /*On commence par entrer dans la liste de déserts en partant de son premier fils*/
 XMLElement *currentDesert = desertCategory->FirstChildElement();
 /*On avance dans la liste de déserts tant qu'il y en a un qui existe*/
 while(currentDesert != nullptr) {
  nbDeserts = nbDeserts + 1;
  currentDesert = currentDesert->NextSiblingElement();
 }

 return nbDeserts;
}

/**
* /**
 * Méthode itérative qui compte d'éléments du type de catégorie passé en paramètre
 * @param categoryName Nom de la catégorie dont on veut compter le nombre d'élément 
 * @return nbElemCat -> Nombre d'éléments de catégorie categoryName
 */
int Mondial::getNbElemCat(const string categoryName) {
    /*
     * A COMPLETER
     */
 int nbElemCat = 0;
 /*On se place dans la catégorie de type categoryName passée en paramètre*/
 XMLElement *category = racineMondial->FirstChildElement(decod_category.at(categoryName).c_str());
 /*On commence par entrer dans la liste de déserts en partant de son premier fils*/
 XMLElement *currentDesert = category->FirstChildElement();
 /*On avance dans la liste de déserts tant qu'il y en a un qui existe*/
 while(currentDesert != nullptr) {
  nbElemCat = nbElemCat + 1;
  currentDesert = currentDesert->NextSiblingElement();
 }
 return nbElemCat;
}

/**
 * Méthode récursive qui retourne un pointeur de type XMLElement* sur l’élément <country> correspondant à un pays identifié par
 * son nom passé en paramètre
 * @param countryName élément <name> de <country> dont on veut identifier l'élément <country>, élément parent
 * @return getCountryXmlelementFromNameRecWorker(currentCountryElement, countryName) -> le worker récursif
 */
XMLElement* Mondial::getCountryXmlelementFromNameRec(string countryName) const {
    /*
     * A COMPLETER
     */
 /*On se place dans la catégorie des pays du monde*/
 XMLElement *countryCategory = racineMondial->FirstChildElement("countriescategory");
 /*On commence par entrer dans la liste de pays en partant de son premier fils.*/
 XMLElement *currentCountryElement = countryCategory->FirstChildElement();
 /*Appel du worker récursif qui parcourt la liste de pays*/
 return getCountryXmlelementFromNameRecWorker(currentCountryElement, countryName);
}

/**
 * Worker auxiliaire récursif qui est utilisé par la méthode getCountryXmlelementFromNameRec(string countryName)
 * @param currentCountryElement élément <country> courant qui est comparé à countryName
 * @param countryName élément <name> de <country> dont on veut identifier l'élément <country>, élément parent
 * @return nullptr | currentCountryElement | appel récursif qui parcourt les éléments <country>
 */
XMLElement* Mondial::getCountryXmlelementFromNameRecWorker(XMLElement* currentCountryElement, string countryName) const {
 /*
  * A COMPLETER
  */
 /*Cas 1 => le pays courant est nul donc on renvoie nul*/
 /*Cas 2 => le pays courant est égal au pays passé en paramètre*/

 if(currentCountryElement == nullptr) {
   return nullptr;
 }

 XMLElement* nameCountryElement = currentCountryElement->FirstChildElement("name");
 if (nameCountryElement->GetText() == countryName) {
  return currentCountryElement;
 }

 return getCountryXmlelementFromNameRecWorker(currentCountryElement->NextSiblingElement(), countryName);
}


/**
 * Méthode qui retourne le code d'un pays (attribut car_code de <country>) identifié par son nom passé en paramètre
 * @param countryName Nom du pays dont on veut connaitre le code
 * @return foundCountryNameElement->Attribute("car_code") -> Code du pays de nom countryName
 */
string Mondial::getCountryCodeFromName(string countryName) const throw (PrecondVioleeExcep) {
    /*
     * A COMPLETER
     */
 /*Trouve l'élément XML d'un pays identifié par countryName passé en paramètre*/
 XMLElement* foundCountryNameElement = getCountryXmlelementFromNameRec(countryName);

 /*Lancer l'exception PrecondVioleeExcep si le pays countryName passé en paramètre n'existe pas dans Mondial.*/
 if(foundCountryNameElement == nullptr) {
  throw PrecondVioleeExcep("Exception pour précondition violée : Dans getCountryCodeFromName, le pays " + countryName + " n'existe pas");
 }

 return foundCountryNameElement->Attribute("car_code");
}

/**
 * élément <country> d'un pays identifié par son nom countryName
 * @param countryName Nom du pays dont on veut obtenir l'élément <country>
 * @return pointeur sur l'élément <country> dont la valeur du fils <name> est égal à countryName, nullptr sinon
 */
XMLElement* Mondial::getCountryXmlelementFromNameIter(string countryName) const {
    /*
     * A COMPLETER
     */
 /*On récupère les pays dans la catégorie des pays*/
 XMLElement* currentCountryElement = racineMondial->FirstChildElement("countriescategory")->FirstChildElement("country");
 /*Element XML avec un élément enfant name égal à la chaine countryName passée en paramètre, null sinon*/
 XMLElement* foundCountryNameElement;

 /*Parcours des pays tant que l'on est pas à la fin et que l'élément name n'est pas égal à la chaine passée en paramètre*/
 while(currentCountryElement != nullptr && currentCountryElement->FirstChildElement("name")->GetText() != countryName) {
  currentCountryElement = currentCountryElement->NextSiblingElement("country");
 }

 if(currentCountryElement == nullptr) {
  foundCountryNameElement = nullptr;
 }else {
  foundCountryNameElement = currentCountryElement;
 }

 return foundCountryNameElement;
}

/**
 * Méthode qui retourne la valeur de la dernière mesure (la plus récente) de population d'un pays identifié par son nom passé en
 * paramètre
 * @param countryName Nom du pays dont on veut connaitre la mesure la plus récente de sa population
 * @return -1 si countryName n'existe pos | 0 si aucune population renseignée | atoi(countryPopElement->GetText()) sinon
 */
int Mondial::getCountryPopulationFromName(string countryName) const {
    /*
     * A COMPLETER
     */
 XMLElement* countryNameElement = getCountryXmlelementFromNameIter(countryName);

 if(countryNameElement == nullptr) {
  return -1;
 }

 XMLElement* countryPopElement = countryNameElement->FirstChildElement("population");
 if(countryPopElement == nullptr) {
  return 0;
 }

 while(countryPopElement->NextSiblingElement("population") != nullptr) {
  countryPopElement = countryPopElement->NextSiblingElement("population");
 }

 return atoi(countryPopElement->GetText());
}

/**
 * élément <country> d'un pays identifié par son code qui est contenu dans l'attribut car_code
 * @param countryCode code du pays dont on veut obtenir l'élément <country>
 * @return pointeur sur l'élément <country> dont l'attribut car_code est égal à countryCode, nullptr sinon
 */
XMLElement* Mondial::getCountryXmlelementFromCode(string countryCode) const {
    /*
     * A COMPLETER
     */
 /*On récupère les pays dans la catégorie des pays*/
 XMLElement* currentCountryElement = racineMondial->FirstChildElement("countriescategory")->FirstChildElement("country");
 /*Element XML avec un attribut enfant car_code égal à la chaine countryCode passée en paramètre, null sinon*/
 XMLElement* foundCountryCodeElement;

 /*Parcours des pays tant que l'on est pas à la fin et que l'attribut car_code n'est pas égal à la chaine passée en paramètre*/
 while(currentCountryElement != nullptr && currentCountryElement->Attribute("car_code") != countryCode) {
  currentCountryElement = currentCountryElement->NextSiblingElement("country");
 }

 if(currentCountryElement == nullptr) {
  foundCountryCodeElement = nullptr;
 }else {
  foundCountryCodeElement = currentCountryElement;
 }

 return foundCountryCodeElement;
}

/**
 * Méthode qui affiche le nom de chaque pays frontalier du pays de nom passé en paramètre 
 * @param countryName Le nom du pays dont on veut connaitre les pays frontaliers avec la distance qui les sépare
 */
void Mondial::printCountryBorders(string countryName) const {
    /*
     * A COMPLETER
     */
 /*Récupération du pays de nom passé en paramètre*/
 XMLElement* targetedCountryElementByName = getCountryXmlelementFromNameIter(countryName);
 cout << "Le pays : " << countryName << endl;

 if(targetedCountryElementByName == nullptr) {
  cout << " n'existe pas" << endl;
 }else {
  /*Recupération des pays frontaliers au pays concerné*/
  XMLElement* targetedCountryBorderElement = targetedCountryElementByName->FirstChildElement("border");

  if (targetedCountryBorderElement == nullptr) {
   cout << " n'a pas de pays frontalier." << endl;
  }else {
   while(targetedCountryBorderElement != nullptr) {
    cout << "\n est frontalier avec : " << getCountryXmlelementFromCode(targetedCountryBorderElement->Attribute("country"))->FirstChildElement("name")->GetText()<<
     ", la longueur de sa frontière avec celui-ci est : " << targetedCountryBorderElement->Attribute("length") << endl;

    targetedCountryBorderElement = targetedCountryBorderElement->NextSiblingElement("border");
   }
  }
 }
}


/**
 * Méthode qui retourne l'élement <river> à partir de son élément enfant <name>
 * @param riverName Nom du fleuve dont on veut connaitre son élément dans Mondial_HB.xml
 * @return foundRiverNameElement l'élément XML avec un élément <name> égal à riverName
 */
XMLElement* Mondial::getRiverXmlelementFromNameIter(string riverName) const {
    /*
     * A COMPLETER
     */
 XMLElement* currentRiverElement = racineMondial->FirstChildElement("riverscategory")->FirstChildElement("river");
 XMLElement* foundRiverNameElement;

 while(currentRiverElement != nullptr && currentRiverElement->FirstChildElement("name")->GetText() != riverName) {
  currentRiverElement = currentRiverElement->NextSiblingElement("river");
 }

 if(currentRiverElement == nullptr) {
  foundRiverNameElement = nullptr;
 }else {
  foundRiverNameElement = currentRiverElement;
 }

 return foundRiverNameElement;
}

/**
 * Méthode qui affiche tous les pays traversés par un fleuve de nom riverName
 * @param riverName Nom du fleuve dont on veut connaitre les pays qu'il traverse
 */
void Mondial::printAllCountriesCrossedByRiver(string riverName) const {
 /*
  * A COMPLETER
  */
 XMLElement* targetedRiverElementByName = getRiverXmlelementFromNameIter(riverName);

 cout << "Le fleuve : " << riverName << endl;
 if(targetedRiverElementByName == nullptr) {
  cout << " n'existe pas" << endl;
 }else {
  string targetedRiverCountryAtt = targetedRiverElementByName->Attribute("country");
  vector<string> crossedCountriesCodeByTargetedRiver = split(targetedRiverCountryAtt, ' ');

  cout << "traverse les pays suivants : " ;
  for(const string& crossedCountryCodeByTargetedRiver : crossedCountriesCodeByTargetedRiver) {
    cout << getCountryXmlelementFromCode(crossedCountryCodeByTargetedRiver)->FirstChildElement("name")->GetText() << ", ";
  }

  cout << "; il a la longueur suivante : " << targetedRiverElementByName->FirstChildElement("length")->GetText() << endl;
 }
}

/*
 * A COMPLETER
 */
void Mondial::printCountriesWithProvincesCrossedByRiver(string riverName) const {
    /*
     * A COMPLETER
     */
 XMLElement* targetedRiverElementByName = getRiverXmlelementFromNameIter(riverName);

 cout << "Le fleuve : " << riverName << endl;
 if(targetedRiverElementByName == nullptr) {
  cout << " n'existe pas" << endl;
 }else {
  XMLElement* targetedRiverLocatedElement = targetedRiverElementByName->FirstChildElement("located");

  cout << "traverse les pays suivants : " ;
  while(targetedRiverLocatedElement != nullptr) {
   cout <<
    getCountryXmlelementFromCode(targetedRiverLocatedElement->Attribute("country"))->FirstChildElement("name")->GetText() << ", ";

   targetedRiverLocatedElement = targetedRiverLocatedElement->NextSiblingElement("located");
  }
  cout << "; il a la longueur suivante : " << targetedRiverElementByName->FirstChildElement("length")->GetText() << endl;
 }
}

/**
* Méthode qui affiche pour un fleuve identifié par son nom riverName, sa longueur, le nom de tous les pays qu’il
* traverse, et pour chaque pays traversé qui possède des divisions administratives, le nom de la ou des divisions administratives
* qu’il traverse.
* @param riverName le nom du fleuve dont on veut connaitre les informations
*/
void Mondial::printCountriesAndProvincesCrossedByRiver(string riverName) const {
    /*
     * A COMPLETER
     */
 /*Récupération de l'élément river de nom riverName passé en paramètre*/
 XMLElement* targetedRiverElementByName = getRiverXmlelementFromNameIter(riverName);

 cout << "Le fleuve : " << riverName;
 /*On vérifie si l'élément river avec un nom riverName existe bien dans la catégorie riverscategory */
 if(targetedRiverElementByName == nullptr) {
  cout << " n'existe pas" << endl;
 }else {
  cout << " de longueur " << targetedRiverElementByName->FirstChildElement("length")->GetText() << " traverse les pays suivants : ";
  XMLElement* riverLocatedElement = targetedRiverElementByName->FirstChildElement("located");

  /*Parcours des pays qui sont traversés par le fleuve*/
  while (riverLocatedElement != nullptr) {
   // Obtenir le code et le nom du pays;
   XMLElement* crossedCountryElement = getCountryXmlelementFromCode(riverLocatedElement->Attribute("country"));

   if(crossedCountryElement != nullptr) {
    cout << "\n - " << crossedCountryElement->FirstChildElement("name")->GetText();
    string riverProvinceAtt = riverLocatedElement->Attribute("province");
    vector<string> crossedProvincesList = split(riverProvinceAtt, ' ');

    for(const string& crossedProvince : crossedProvincesList) {
     XMLElement* countryProvinceElement = crossedCountryElement->FirstChildElement("province");
     while (countryProvinceElement != nullptr) {
      if (crossedProvince == countryProvinceElement->Attribute("id")) {
       cout << "\n   * " << countryProvinceElement->FirstChildElement("name")->GetText();
      }
      countryProvinceElement = countryProvinceElement->NextSiblingElement("province");
     }
    }
   }
   riverLocatedElement = riverLocatedElement->NextSiblingElement("located");
  }
 }
}

/*
 * A COMPLETER
 */
void Mondial::printCityInformation(string cityName) const {
    /*
     * A COMPLETER
     */
 XMLElement* currentCountryElement = racineMondial->FirstChildElement("countriescategory")->FirstChildElement("country");
 //Parcours des pays
 //Vérifier si la balise <city> est présente
 //Je comprends pas comment faire avec les provinces qui sont enfant de city et city qui est enfant direct de country.

}



/**
 * Exemple de question additionnelle pour l'exercice 9 afficher toutes les informations disponibles
 * dans Mondial concernant toutes les îles.
 * On peut commencer par une île en particulier à partir de son nom
 */
void Mondial::printIslandsInformations() const {
    /*
     * A COMPLETER
     */
 // Récupérer la catégorie des îles
 XMLElement* islandCategoryElement = racineMondial->FirstChildElement("islandscategory");
  // Parcourir toutes les îles dans cette catégorie
  XMLElement* currentIslandElement = islandCategoryElement->FirstChildElement("island");

  cout << "Informations sur toutes les îles dans Mondial : " << endl;

  while (currentIslandElement != nullptr) {
   // Récupérer les informations de chaque île
   string name = currentIslandElement->FirstChildElement("name") ? currentIslandElement->FirstChildElement("name")->GetText() : "Inconnu";
   string islands = currentIslandElement->FirstChildElement("islands") ? currentIslandElement->FirstChildElement("islands")->GetText() : "Inconnu";
   string area = currentIslandElement->FirstChildElement("area") ? currentIslandElement->FirstChildElement("area")->GetText() : "Inconnu";
   string latitude = currentIslandElement->FirstChildElement("latitude") ? currentIslandElement->FirstChildElement("latitude")->GetText() : "Inconnu";
   string longitude = currentIslandElement->FirstChildElement("longitude") ? currentIslandElement->FirstChildElement("longitude")->GetText() : "Inconnu";
   string elevation = currentIslandElement->FirstChildElement("elevation") ? currentIslandElement->FirstChildElement("elevation")->GetText() : "Inconnu";

   cout << "Nom de l'île : " << name << endl;
   cout << "Nom des îles : " << islands << endl;
   cout << "Surface : " << area << " km²" << endl;
   cout << "Latitude : " << latitude << endl;
   cout << "Longitude : " << longitude << endl;
   cout << "Altitude : " << elevation << " mètres" << endl;

   // Passer à l'île suivante
   currentIslandElement = currentIslandElement->NextSiblingElement("island");
 }
}

/*
 * Méthodes de service fournies
 */

template<typename Out>
void Mondial::split(string& s, char delim, Out result) const {
    stringstream ss(s);
    string item;
    while (getline(ss, item, delim)) {
        *(result++) = item;
    }
}

/**
 * Méthode à utiliser pour découper les mots d'une chaîne dans un vecteur
 * Utile pour la gestion des attributs à valeurs multiples
 * @param s chaîne à découper
 * @param delim délimiteur des mots de la chaîne à découper
 * @return vecteur contenant les mots de la chaîne découpée
 */
vector<std::string> Mondial::split(string& s, char delim) const {
    vector<std::string> elems;
    split(s, delim, back_inserter(elems));
    return elems;
}

Mondial::~Mondial() {
}