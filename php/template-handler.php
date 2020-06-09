<?php
class TemplateHandler
{
    private $page;
    private $root;

    public function __construct(string $root, string $standard)
    {
        if ($standard != "xhtml") {
            throw new UnexpectedValueException("Unrecognized standard declared", 1);
        }

        $this->root = $root;
        $this->page = file_get_contents(__DIR__ . "/components/" . $standard . "-template.php");
    }

    public function setTitle(string $title)
    {
        $this->page = str_replace("<titlePlaceholder />", $title, $this->page);
    }

    public function setDescription(string $description)
    {
        $this->page = str_replace("<descriptionPlaceholder />", $description, $this->page);
    }

    public function setAuthor(string $author)
    {
        $this->page = str_replace("<authorPlaceholder />", $author, $this->page);
    }

    public function setOtherMeta(string $tags)
    {
        $this->page = str_replace("<metaPlaceholder />", $tags, $this->page);
    }

    public function setLogin(string $loginSnippet)
    {
        $this->page = str_replace("<loginPlaceholder />", $loginSnippet, $this->page);
    }

    public function setNav(string $navSnippet)
    {
        $this->page = str_replace("<navPlaceholder />", $navSnippet, $this->page);
    }

    public function setBreadcrumb(string $breadcrumbSnippet)
    {
        $this->page = str_replace("<breadcrumbPlaceholder />", $breadcrumbSnippet, $this->page);
    }

    public function setContent(string $contentSnippet)
    {
        $this->page = str_replace("<contentPlaceholder />", $contentSnippet, $this->page);
    }

    public function setBackToTop(string $backToTopSnippet)
    {
        $this->page = str_replace("<backToTopPlaceholder />", $backToTopSnippet, $this->page);
    }

    public function setAnnulla(string $annullaSnippet)
    {
        $this->page = str_replace("<annullaPlaceholder />", $annullaSnippet, $this->page);
    }

    public function setFooter(string $footerSnippet)
    {
        $this->page = str_replace("<footerPlaceholder />", $footerSnippet, $this->page);
    }

    public function send()
    {
        $this->done();
        echo $this->page;
    }

    public function save(string $file)
    {
        $this->done();
        file_put_contents($file, $this->page);
    }

    private function decorate()
    {
        //Bisogna aggiungere, dopo tutti i link, il link fra quadre, per la stampa
    }

    private function done()
    {
        $this->page = str_replace("<rootFolder />", $this->root, $this->page);
    }
}
