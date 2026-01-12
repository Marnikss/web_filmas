import '../css/loader.css';
import { useEffect, useState } from "react";

const topFilmas = [
    { 
        "id": 1, 
        "name": "Interstellar", 
        "description": "Zinātniskā fantastikas filma par kosmosa izpēti un cilvēces nākotni. Bija laiks, kad bijušais NASA pilots Cooper atgriežas pie zemnieka dzīves kopā ar savu ģimeni.", 
        "image": "https://images.unsplash.com/photo-1536440136628-849c177e76a1" 
    },
    { 
        "id": 2, 
        "name": "Klusais okeāns", 
        "description": "Piedzīvojumu filma par zemūdens pasaulēm un noslēpumiem. Grupa zinātnieku dodas dziļi okeānā, lai atklātu sen aizmirstas civilizācijas paliekas.", 
        "image": "https://images.unsplash.com/photo-1489599809516-9827b6d1cf13" 
    },
    // PIEVIENO TREŠO FILMU
    { 
        "id": 3, 
        "name": "Kalnu piedzīvojumi", 
        "description": "Piedzīvojumu drāma par kalnu kāpējiem un to izdzīvošanas gribu. Divi draugi dodas bīstamā ekspedīcijā uz nesasniegtu virsotni.", 
        "image": "https://images.unsplash.com/photo-1543536448-d209d2d13a1c" 
    },
];

const selectedFilmas = {
    "id": 3,
    "name": "Kalnu piedzīvojumi",
    "description": "Piedzīvojumu drāma par kalnu kāpējiem...",
    "image": "https://images.unsplash.com/photo-1543536448-d209d2d13a1c"
};

const relatedFilmas = [
    { "id": 4, "name": "Pēdējā fronte", "description": "Kara drāma...", "image": "https://images.unsplash.com/photo-1489599809516-9827b6d1cf13" },
    { "id": 5, "name": "Zvaigžņu ceļš", "description": "Zinātniskā fantastika...", "image": "https://images.unsplash.com/photo-1536440136628-849c177e76a1" },
    { "id": 6, "name": "Zvaigžņu ceļš", "description": "Zinātniskā fantastika...", "image": "https://images.unsplash.com/photo-1536440136628-849c177e76a1" },
];
export default function App() {
    const [selectedFilmasID, setSelectedFilmasID] = useState(null);
    // funkcija Filma ID saglabāšanai stāvoklī
    function handleFilmasSelection(filmaID) {
        setSelectedFilmasID(filmaID);
    }
    
    // funkcija filmas izvēles atcelšanai
    function handleGoingBack() {
        setSelectedFilmasID(null);
    }

    return (
        <>
            <Header />
                <main className="mb-8 px-2 md:container md:mx-auto">
                    {selectedFilmasID ? <FilmasPage selectedFilmasID={selectedFilmasID}
                        handleFilmasSelection={handleFilmasSelection}
                        handleGoingBack={handleGoingBack} /> 
                        : <Homepage handleFilmasSelection={handleFilmasSelection} />}
                </main>
            <Footer />
        </>
        )
}
// Galvene un kājene – strukturālas komponentes bez funkcijām vai datiem
function Header() {
return (
    <header className="bg-green-500 mb-8 py-2 sticky top-0">
        <div className="px-2 py-2 font-serif text-green-50 text-xl leading-6
            md:container md:mx-auto">
            2. Praktiskais Darbs
        </div>
    </header>
)
}
function Footer() {
return (
    <footer className="bg-neutral-300 mt-8">
        <div className="py-8 md:container md:mx-auto px-2">
            D. Bērziņš
        </div>
    </footer>
)
}
// Sākumlapa- ielādē datus no API un attēlo top grāmatas
function Homepage({ handleFilmasSelection }) {
    const [topFilmas, setTopFilmas] = useState([]);
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState(null);
    useEffect(function () {
        async function fetchTopFilmas() {
            try {
                setIsLoading(true);
                setError(null);
                const response = await fetch('http://localhost:8000/data/get-top-filmas');
                if (!response.ok) {
                    throw new Error("Datu ielādes kļūda. Lūdzu, pārlādējiet lapu!");
                }
                const data = await response.json();
                console.log('top filmas fetched', data);
                setTopFilmas(data);
            } catch (error) {
                setError(error.message);
            }finally {
                setIsLoading(false);
            }
        }
        fetchTopFilmas();
    }, []);
    return (
        <>
            {isLoading && <Loader />}
            {error && <ErrorMessage msg={error} />}
            {!isLoading && !error && (
                topFilmas.map((filmas, index) => (
                    <TopFilmasView
                        filmas={filmas}
                        key={filmas.id}
                        index={index}
                        handleFilmasSelection={handleFilmasSelection}
                    />
            )))}
        </>
    )
}
// Top filmas skats- attēlo sākumlapas filmas
function TopFilmasView({ filmas, index, handleFilmasSelection }) {
    const [error, setError] = useState(null);
    return (
        <div className="bg-neutral-100 rounded-lg mb-8 py-8 flex flex-wrap md:flex-row">
            <div className=
                {`order-2 px-12 md:basis-1/2
                ${ index % 2 === 1 ? "md:order-1 md:text-right" : ""}
                `}
            >
                <h2 className="mb-4 text-3xl leading-8 font-light text-neutral-900">
                    {filmas.name}
                </h2>
                <p className="mb-4 text-xl leading-7 font-light text-neutral-900 mb-4">
                    { filmas.description
                    ? (filmas.description.split(' ').slice(0, 16).join(' ')) + '...'
                    : '' }
                </p>
                <SeeMoreBtn filmasID={filmas.id} handleFilmasSelection={handleFilmasSelection}/>
            </div>
            <div className=
                {`order-1 md:basis-1/2 ${ index % 2 === 1 ? "md:order-2" : ""}`}
                >
                <img
                    src={ filmas.image }
                    alt={ filmas.name }
                    className="p-1 rounded-md border border-neutral-200 w-2/4 aspect-auto
                    mx-auto" />
            </div>
        </div>
    )
}
// Poga “Rādīt vairāk”
function SeeMoreBtn({ filmasID, handleFilmasSelection }) {
    return (
        <button
            className="inline-block rounded-full py-2 px-4 bg-sky-500 hover:bgsky-400 text-sky-50 cursor-pointer"
            onClick={() => handleFilmasSelection(filmasID)}
            >Rādīt vairāk
        </button>
    )
}

// Filmas lapa – strukturāla komponente, kas satur filmas lapas daļas
function FilmasPage({ selectedFilmasID, handleFilmasSelection, handleGoingBack }) {
    return (
    <>
        <SelectedFilmasView
            selectedFilmasID={selectedFilmasID}
            handleGoingBack={handleGoingBack}
        />
        <RelatedFilmasSection
            relatedFilmasID={selectedFilmasID}
            handleFilmasSelection={handleFilmasSelection}
        />
    </>
    )
}

// Izvēlētās Filmas skats- attēlo datus
function SelectedFilmasView({ selectedFilmasID, handleGoingBack }) {
    const [selectedFilmas, setSelectedFilmas] = useState({});
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState(null);

    useEffect(function () {
    async function fetchSelectedFilmas() {
    try {
        setIsLoading(true);
        setError(null);
        const response = await fetch('http://localhost:8000/data/get-filmas/' +
        selectedFilmasID);
        if (!response.ok) {
            throw new Error("Datu ielādes kļūda. Lūdzu, pārlādējiet lapu!");
        }
        const data = await response.json();
        console.log('filmas ' + selectedFilmasID + ' fetched', data);
        setSelectedFilmas(data);
    } catch (error) {
        setError(error.message);
    } finally {
        setIsLoading(false);
    }
    }
    fetchSelectedFilmas();
    }, [selectedFilmasID]);

    return (
            <>
                {isLoading && <Loader />}
                {error && <ErrorMessage msg={error} />}
                {!isLoading && !error && <>
                <div className="rounded-lg flex flex-wrap md:flex-row">
                    <div className="order-2 md:order-1 md:pt-12 md:basis-1/2">
                        <h1 className="text-3xl leading-8 font-light text-neutral-900 mb-2">
                            {selectedFilmas.name}
                        </h1>
                        <p className="text-xl leading-7 font-light text-neutral-900 mb-2">
                            {selectedFilmas.rezisori}
                        </p>
                        <p className="text-xl leading-7 font-light text-neutral-900 mb-4">
                            {selectedFilmas.description}
                        </p>
                        <dl className="mb-4 md:flex md:flex-wrap md:flex-row">
                        <dt className="font-bold md:basis-1/4">
                            Izdošanas gads
                        </dt>
                        <dd className="mb-2 md:basis-3/4">
                            {selectedFilmas.year}
                        </dd>
                        <dt className="font-bold md:basis-1/4">
                            Cena
                        </dt>
                        <dd className="mb-2 md:basis-3/4">
                            &euro; {selectedFilmas.price}
                        </dd>
                        <dt className="font-bold md:basis-1/4">
                            Kategorija
                        </dt>
                        <dd className="mb-2 md:basis-3/4">
                            {selectedFilmas.kategorija}
                        </dd>
                        </dl>
                    </div>
                    <div className="order-1 md:order-2 md:pt-12 md:px-12 md:basis-1/2">
                            <img
                            src={selectedFilmas.image}
                            alt={selectedFilmas.name}
                            className="p-1 rounded-md border border-neutral-200 mx-auto" />
                    </div>
                </div>
                <div className="mb-12 flex flex-wrap">
                    <GoBackBtn handleGoingBack={handleGoingBack} />
                </div>
            </>}
            </>
            )
        }
// Poga “Uz sākumu”
function GoBackBtn({ handleGoingBack }) {
    return (
        <button
            className="inline-block rounded-full py-2 px-4 bg-neutral-500
            hover:bg-neutral-400 text-neutral-50 cursor-pointer"
            onClick={handleGoingBack}
        >Uz sākumu</button>
    )
}

// Līdzīgo grāmatu sadaļa
function RelatedFilmasSection({ relatedFilmasID, handleFilmasSelection }) {
    const [relatedFilmas, setRelatedFilmas] = useState([]);
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState(null);

    useEffect(function () {
        async function fetchRelatedFilmas() {
        try {
            setIsLoading(true);
            setError(null);
            const response = await fetch('http://localhost:8000/data/get-related-filmas/' +
            relatedFilmasID);
            if (!response.ok) {
                throw new Error("Datu ielādes kļūda. Lūdzu, pārlādējiet lapu!");
            }
            const data = await response.json();
            console.log('filmas ' + relatedFilmasID + ' fetched', data);
            setRelatedFilmas(data);
        } catch (error) {
            setError(error.message);
        } finally {
            setIsLoading(false);
        }
        }
        fetchRelatedFilmas();
    }, [relatedFilmasID]);

    return (
    <>
        {isLoading && <Loader />}
        {error && <ErrorMessage msg={error} />}
        {!isLoading && !error && <>    
        <div className="flex flex-wrap">
            <h2 className="text-3xl leading-8 font-light text-neutral-900 mb4">
                Līdzīgas filmas
            </h2>
        </div>
        <div className="flex flex-nowrap overflow-x-auto md:overflow-visible gap-4 pb-4">
            {relatedFilmas.map( filmas => (
                <RelatedFilmasView
                    filmas={filmas}
                    key={filmas.id}
                    handleFilmasSelection={handleFilmasSelection}
                />
            ))}
        </div>
        </>}
    </>
    )
}

// Līdzīgās grāmatas skats
function RelatedFilmasView({ filmas, handleFilmasSelection }) {
    return (
        <div className="rounded-lg mb-4 flex-shrink-0 w-full md:w-1/3 px-2">
            <img
            src={ filmas.image }
            alt={ filmas.name }
            className="md:h-[400px] md:mx-auto max-md:w-2/4 max-md:mx-auto" />
            <div className="p-4">
                <h3 className="text-xl leading-7 font-light text-neutral-900 mb4">
                { filmas.name }
                </h3>
                <SeeMoreBtn
                filmasID={filmas.id}
                handleFilmasSelection={handleFilmasSelection}
                />
            </div>
        </div>
    )
}

// Ielādes indikators un kļūdas
function Loader() {
    return (
        <div className="my-12 px-2 md:container md:mx-auto text-center clear-both">
            <div className="loader">
            </div>
        </div>
    )
}
function ErrorMessage({ msg }) {
return (
<div className="md:container md:mx-auto bg-red-300 my-8 p-2">
<p className="text-black">{ msg }</p>
</div>
)
}