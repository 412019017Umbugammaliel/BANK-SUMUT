<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">	
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <h1 class="app-page-title mb-0">Invoice</h1>
                </div>
              <!-- DESC SUMMARY ============================================================================================================================== -->
                <div class="col-sm-12 col-md-12 col-lg-12 mt-4 mb-5 hr_summary_parent accordion-collapse collapse show" id="summaryOrder" aria-labelledby="cekSummary">
                    <div>
                        <div class="row">
                            <span class="titleSummary">SUMMARY</span>                                
                            <div class="col-12 m-0">
                                <!-- SUMMARY ====================================================================== -->
                                <div class="row mt-1 h-line-summary bgColor m-0">
                                    <div class="col-5 header-summary p-0">Currency</div>
                                    <div class="col-7 body-summary text-end p-0"><span id="currency">IDR</span></div>
                                </div>
                                <div class="row mt-1 h-line-summary bgColor m-0">
                                    <div class="col-5 header-summary p-0">Data Center</div>
                                    <div class="col-7 body-summary text-end p-0"><span id="dataCenter">Indonesia, Area 31 Jakarta 1</span></div>
                                </div>
                                <div class="row mt-1 h-line-summary bgColor m-0">
                                    <div class="col-5 header-summary p-0">Billing Mode</div>
                                    <div class="col-7 body-summary text-end p-0"><span id="BillingMode">Monthly</span></div>
                                </div>
                                <!-- ============================================================================== -->
                            </div>
                        </div>
                            <div class="row m-auto">
                                <!-- Specification ================================================================ -->
                                <a class="titleSubSummary accordion-sub_summary mt-2" id="specificationAccordion" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#contentSpesification" aria-expanded="false"
                                    aria-controls="contentSpesification">
                                    Specification
                                </a>
                                <div class="hr_summary"></div>
                                <div class="accordion-collapse collapse show p-0" id="contentSpesification" aria-labelledby="specificationAccordion">
                                    <div class="row mt-1 h-line-summary bgColor">
                                        <div class="col-4 header-summary p-0">Data Center</div>
                                        <div class="col-4 body-summary text-start p-0"><span id="dataCenterDescOrder"></span> <span> x </span> <span id="dataCenterDescVMS"></span> <span> VM's </span> </div>
                                        <div class="col-4 body-summary text-end p-0"><span id="dataCenterPrice"></span></div>
                                    </div>
                                    <div class="row mt-1 h-line-summary bgColor">
                                        <div class="col-4 header-summary p-0">WINDOWS License</div>
                                        <div class="col-4 body-summary text-start p-0"><span id="WindowsLicenseDescOrder"></span> <span> x </span> <span id="WindowsLicenseDescVMS"></span> <span> VM's </span> </div>
                                        <div class="col-4 body-summary text-end p-0"><span id="WindowsLicensePrice"></span></div>
                                    </div>
                                    <div class="row mt-1 h-line-summary bgColor">
                                        <div class="col-4 header-summary p-0">CPU</div>
                                        <div class="col-4 body-summary text-start p-0"><span id="CPUDescOrder"></span> <span> x </span> <span id="CPUDescVMS"></span> <span> VM's </span> </div>
                                        <div class="col-4 body-summary text-end p-0"><span id="CPUPrice"></span></div>
                                    </div>
                                    <div class="row mt-1 h-line-summary bgColor">
                                        <div class="col-4 header-summary p-0">Memory</div>
                                        <div class="col-4 body-summary text-start p-0"><span id="memoryDescOrder"></span> <span>GB x </span> <span id="memoryDescVMS"></span> <span> VM's </span> </div>
                                        <div class="col-4 body-summary text-end p-0"><span id="memoryPrice"></span></div>
                                    </div> 
                                    <div class="row mt-1 h-line-summary bgColor">
                                        <div class="col-4 header-summary p-0">Storage</div>
                                        <div class="col-4 body-summary text-start p-0"><span id="storageDescOrder"></span> <span>GB x </span> <span id="storageDescVMS"></span> <span> VM's </span> </div>
                                        <div class="col-4 body-summary text-end p-0"><span id="storagePrice"></span></div>
                                    </div>
                                </div>
                                <!-- ============================================================================== -->
                                <!-- Network Add-Ons ============================================================== -->
                                <a class="titleSubSummary accordion-sub_summary mt-2" id="NetAddOnsAccordion" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#contentNetAddOns" aria-expanded="false"
                                    aria-controls="contentNetAddOns">
                                    Network Add-Ons
                                </a>            
                                <div class="hr_summary"></div>          
                                <div class="accordion-collapse collapse show p-0" id="contentNetAddOns" aria-labelledby="NetAddOnsAccordion">
                                    <div class="row mt-1 h-line-summary bgColor">
                                        <div class="col-4 header-summary p-0">Traffic</div>
                                        <div class="col-4 body-summary text-start p-0"><span id="trafficDesc"></span> <span> x </span> <span id="trafficDescVMS"></span> <span> VM's </span></div>
                                        <div class="col-4 body-summary text-end p-0"><span id="trafficPrice"></span></div>
                                    </div>
                                    <div class="row mt-1 h-line-summary bgColor">
                                        <div class="col-4 header-summary p-0">Speed</div>
                                        <div class="col-4 body-summary text-start p-0"><span id="speedDesc"></span> <span> x </span> <span id="speedDescVMS"></span> <span> VM's </span></div>
                                        <div class="col-4 body-summary text-end p-0"><span id="speedPrice"></span></div>
                                    </div>
                                    <div class="row mt-1 h-line-summary bgColor">
                                        <div class="col-4 header-summary p-0">IPV4</div>
                                        <div class="col-4 body-summary text-start p-0"><span id="ipv4Desc"></span> <span> x </span> <span id="ipv4DescVMS"></span> <span> VM's </span></div>
                                        <div class="col-4 body-summary text-end p-0"><span id="ipv4Price"></span></div>
                                    </div>
                                    <div class="row mt-1 h-line-summary bgColor">
                                        <div class="col-4 header-summary p-0">IPV6</div>
                                        <div class="col-4 body-summary text-start p-0"><span id="ipv6Desc"></span> <span> x </span> <span id="ipv6DescVMS"></span> <span> VM's </span></div>
                                        <div class="col-4 body-summary text-end p-0"><span id="ipv6Price"></span></div>
                                    </div> 
                                </div>
                                <!-- ============================================================================== -->
                                <!-- Add-Ons ====================================================================== -->
                                <a class="titleSubSummary accordion-sub_summary mt-2" id="addOnsAccordion" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#contentaddOns" aria-expanded="false"
                                    aria-controls="contentaddOns">
                                    Add-Ons
                                </a>            
                                <div class="hr_summary"></div>          
                                <div class="accordion-collapse collapse show p-0 mb-3" id="contentaddOns" aria-labelledby="addOnsAccordion">
                                    <div class="row mt-1 h-line-summary bgColor">
                                        <div class="col-4 header-summary p-0">Backup</div>
                                        <div class="col-4 body-summary text-start p-0"><span id="backupDesc"></span> <span> x </span> <span id="backupDescVMS"></span> <span> VM's </span></div>
                                        <div class="col-4 body-summary text-end p-0"><span id="backupPrice"></span></div>
                                    </div>
                                    <div class="row mt-1 h-line-summary bgColor">
                                        <div class="col-4 header-summary p-0">Support</div>
                                        <div class="col-4 body-summary text-start p-0"><span id="supportDesc"></span> <span> x </span> <span id="supportDescVMS"></span> <span> VM's </span></div>
                                        <div class="col-4 body-summary text-end p-0"><span id="supportPrice"></span></div>
                                    </div>
                                    <div class="row mt-1 h-line-summary bgColor">
                                        <div class="col-4 header-summary p-0">Security Includes</div>
                                        <div class="col-4 body-summary text-start p-0"><span id="securityDesc"></span> <span> x </span> <span id="securityDescVMS"></span> <span> VM's </span></div>
                                        <div class="col-4 body-summary text-end p-0"><span id="securityPrice"></span></div>
                                    </div>
                                    <div class="row mt-1 h-line-summary bgColor">
                                        <div class="col-4 header-summary p-0">DDOS Protection</div>
                                        <div class="col-4 body-summary text-start p-0"><span id="ddosDesc"></span> <span> x </span> <span id="ddosDescVMS"></span> <span> VM's </span></div>
                                        <div class="col-4 body-summary text-end p-0"><span id="ddosPrice"></span></div>
                                    </div> 
                                </div>
                                <!-- ============================================================================== --> 
                                <!-- Total ======================================================================== -->
                                <div class="row mt-1 bgColor mb-1">
                                    <div class="col-8 header-summary p-0">TOTAL</div>
                                    <div class="col-4 body-summary text-end p-0"><span id="totalPrice"></span></div>
                                </div>
                                <div class="hr_summary"></div>
                                <div class="row mt-1 bgColor mb-1">
                                    <div class="col-8 header-summary p-0">TAX</div>
                                    <div class="col-4 body-summary text-end p-0"><span id="taxPrice"></span></div>
                                </div>
                                <div class="hr_summary"></div>
                                <div class="row mt-1 bgColor mb-1">
                                    <div class="col-8 header-summary p-0">TOTAL+TAX</div>
                                    <div class="col-4 body-summary text-end p-0"><span class="header-summary" id="totalTaxPrice"></span></div>
                                </div>
                                <!-- ============================================================================== -->
                            </div>
                        </div>
                    </div>
                </div>
              <!-- =========================================================================================================================================== -->
            </div>
        </div>
    </div>
</div>