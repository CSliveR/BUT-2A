cmake_minimum_required(VERSION 3.23)
project(Examen2023ACompleter)
set(CMAKE_CXX_STANDARD 14)
if(CMAKE_VERSION VERSION_GREATER_EQUAL "3.24.0")
    cmake_policy(SET CMP0135 NEW)
endif()

# 1. Compilation du programme principal de l'exercice 1
add_executable(exo1 exo1Main.cpp Evaluation_ACOMPLETER.cpp Evaluation_ACOMPLETER.h EvaluationSimple_ACOMPLETER.cpp EvaluationSimple_ACOMPLETER.h EvaluationComplexe_ACOMPLETER.cpp EvaluationComplexe_ACOMPLETER.h ObjetContraint.h)

# 2. Compilation des tests unitaires (exo2)
# Pour inclure la bibliothèque GoogleTest au projet (en allant la chercher sur GitHub)
include(FetchContent)
FetchContent_Declare(
        googletest
        # Specify the commit you depend on and update it regularly.
        URL https://github.com/google/googletest/archive/03597a01ee50ed33e9dfd640b249b4be3799d395.zip
)
# Pour Windows: empêche la redéfinition des réglages de compilation/édition de lien du projet "parent"
set(gtest_force_shared_crt ON CACHE BOOL "" FORCE)
FetchContent_MakeAvailable(googletest)

add_executable(exo2 EvaluationComplexeTest_ACOMPLETER.cpp Evaluation_ACOMPLETER.cpp Evaluation_ACOMPLETER.h EvaluationSimple_ACOMPLETER.cpp EvaluationSimple_ACOMPLETER.h EvaluationComplexe_ACOMPLETER.cpp EvaluationComplexe_ACOMPLETER.h ObjetContraint.h)
# Il faut lier l'exécutable exo2 à la bibliothèque gtest_main
target_link_libraries(exo2 gtest_main)